<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curses = Curs::get();
        if(!$curses)  return response()->json(['status' => false, 'message' => 'Ошибка получения валют из базы']);

        return response()->json(compact('curses'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','curs:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:2',
                'slug' => 'required|min:2|unique:curs',
                'curs' => 'numeric',
//                'img' => 'required|image',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $curs = new Curs();
        $curs->name = $request->name;
        $curs->slug = $request->slug;
        $curs->img = $request->img;
        $curs->curs = $request->curs;
        $curs->base = $request->base;
        if($curs->save()) {
            return response()->json(['status' => true, 'message' => 'Успешно создан!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Валюта не создана.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curs $cur)
    {
        if (!auth()->user()->role->permissions->where('slug','curs:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:2',
                'slug' => 'required|min:2|unique:curs,id,' . $request->id,
                'curs' => 'numeric',
//                'img' => 'required|image',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

//        $curs = new Curs();
        $cur->name = $request->name;
        $cur->slug = $request->slug;
        $cur->img = $request->img;
        $cur->curs = $request->curs;
        $cur->base = $request->base;
        if($cur->save()) {
            return response()->json(['status' => true, 'message' => 'Успешно обновлен!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Валюта не обновлена.']);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curs $cur)
    {
        if (!auth()->user()->role->permissions->where('slug','curs:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        if($cur->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => false, 'message' => 'Удалить не удалось!']);
    }
}
