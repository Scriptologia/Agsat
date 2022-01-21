<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user () {
        $user = User::with(['role', 'role.permissions'])->find(Auth::user())->first();// Auth::user();
        return response()->json(compact('user'));
    }

    public function index()
    {
        if (auth()->user()->role->slug !== 'superadmin') {
            $users = User::with('role')->whereRelation('role','slug','!=','superadmin')->get();
        } else {
            $users = User::with('role')->get();
        }

        if(!$users)  return response()->json(['status' => false, 'message' => 'Ошибка получения пользователей из базы']);

        return response()->json(compact('users'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','user:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
                'role_id' => 'integer|nullable',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role_id;

        if($user->save()) {
            return response()->json(['status' => true, 'message' => 'Успешно создан!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Пользователь не создан.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!auth()->user()->role->permissions->where('slug','user:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:3',
                'email' => ['required', 'email', 'min:5',Rule::unique('users')->ignore($user)],
                'password' => 'min:8|confirmed|nullable',
                'role_id' => 'integer|nullable',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password) $user->password = $request->password;
        $user->role_id = $request->role_id;
        if($user->save()) {
            return response()->json(['status' => true, 'message' => 'Успешно обновлен!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Пользователь не обновлен.']);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->role->permissions->where('slug','user:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        if($user->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }
}
