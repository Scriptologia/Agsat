<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Permission::class, 'permission');
    }
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
            $permissions = Permission::get();
        }
        if(!$permissions)  return response()->json(['status' => false, 'message' => 'Ошибка получения прав из базы']);

        return response()->json(compact('permissions'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
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
    public function update(PermissionRequest $request, Permission $permission)
    {
        $validated = $request->validated();
        if($permission->update($validated)) {
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
        if($permission->delete())  return response()->json(['status' => true, 'message' => 'Успешно удалено!']);
        return response()->json(['status' => false, 'message' => 'Удалить не удалось!']);
    }
}
