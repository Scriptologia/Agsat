<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
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
    public function store(RoleRequest $request)
    {
        $validated = $request->validated();

        $role = Role::create($request->safe()->except(['permissions', 'id']));
        $role->permissions()->attach($validated['permissions']);
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
    public function update(RoleRequest $request, Role $role)
    {
        $validated = $request->validated();
        $role->update($request->safe()->except(['permissions']));
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
        $role->permissions()->detach();
        if($role->delete())  return response()->json(['status' => true, 'message' => 'Успешно удалена!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }
}
