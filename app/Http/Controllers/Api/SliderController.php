<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::get();
        if(!$sliders)  return response()->json(['status' => false, 'message' => 'Ошибка получения слайдера из базы']);

        return response()->json(compact('sliders'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','slider:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
            [
                'text' => 'string|nullable|min:2',
                'url' => 'string|nullable',
                'img' => 'required|string',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        if(Slider::create($request->all())) {
            return response()->json(['status' => true, 'message' => 'Успешно создан!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Слайд не создан.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        if (!auth()->user()->role->permissions->where('slug','slider:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
        $validator = Validator::make($request->all(),
            [
                'text' => 'string|nullable|min:2',
                'url' => 'string|nullable',
                'img' => 'required|string',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        if($slider->update($request->all())) {
            return response()->json(['status' => true, 'message' => 'Успешно обновлен!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Слайд не обновлен.']);}
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if (!auth()->user()->role->permissions->where('slug','slider:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        if($slider->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => false, 'message' => 'Удалить не удалось!']);
    }
}
