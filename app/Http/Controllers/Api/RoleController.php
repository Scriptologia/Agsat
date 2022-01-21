<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->slug !== 'superadmin') {
            $roles = Role::with("permissions")->where('slug', '!=', 'superadmin')->get();}
        else {
            $roles = Role::with('permissions')->get();
        }
        if(!$roles)  return response()->json(['status' => false, 'message' => 'Ошибка получения ролей из базы']);

        return response()->json(compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','role:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:5|unique:roles',
                'slug' => 'required|min:5|unique:roles',
                'permissions' => 'array',
                'description' => 'string|nullable',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $role = Role::create($request->except(['permissions']));
//        $role = new Role();
        $role->permissions()->attach($request->permissions);
        if($role) {
            return response()->json(['status' => true, 'message' => 'Успешно создана!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Роль не создана.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if (!auth()->user()->role->permissions->where('slug','role:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
        $validator = Validator::make($request->all(),
            [
                'name' => ['required', 'min:5',Rule::unique('roles')->ignore($role)],
                'slug' => ['required', 'min:5',Rule::unique('roles')->ignore($role)],
                'permissions' => 'array',
                'description' => 'string|nullable',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $role->update($request->except(['permissions']));
        $role->permissions()->sync($request->permissions);
        if($role) {
            return response()->json(['status' => true, 'message' => 'Успешно обновлена!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Роль не обновлена.']);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (!auth()->user()->role->permissions->where('slug','role:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        $role->permissions()->detach();
        if($role->delete())  return response()->json(['status' => true, 'message' => 'Успешно удалена!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }
}
