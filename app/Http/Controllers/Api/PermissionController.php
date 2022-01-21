<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->slug !== 'superadmin') {
            $permissions = Permission::whereNotIn('slug', array('permission:create', 'permission:update', 'permission:delete'))->get();}
        else {
            $permissions = Permission::get();}
        if(!$permissions)  return response()->json(['status' => false, 'message' => 'Ошибка получения прав из базы']);

        return response()->json(compact('permissions'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','permission:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
        [
            'slug' => 'required|min:5|unique:permissions',
            'description' => 'string|nullable',
        ]
    );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        if(Permission::create($request->all())) {
            return response()->json(['status' => true, 'message' => 'Успешно создано!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Право не создано.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        if (!auth()->user()->role->permissions->where('slug','permission:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
        $validator = Validator::make($request->all(),
            [
                'slug' => ['required', 'min:5',Rule::unique('permissions')->ignore($permission)],
                'description' => 'string|nullable',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);
        if($permission->update($request->all())) {
            return response()->json(['status' => true, 'message' => 'Успешно обновлено!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Право не обновлено.']);}
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if (!auth()->user()->role->permissions->where('slug','permission:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        if($permission->delete())  return response()->json(['status' => true, 'message' => 'Успешно удалено!']);
        return response()->json(['status' => false, 'message' => 'Удалить не удалось!']);
    }
}
