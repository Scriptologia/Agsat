<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resizes = Resize::get();
        if(!$resizes)  return response()->json(['status' => false, 'message' => 'Ошибка получения размеров из базы']);

        return response()->json(['resizes' => $resizes]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:3',
                'width' => 'integer|min: 2',
                'height' => 'integer|min: 2',
                'resizeMimeType' => 'string|nullable'
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        if(Resize::create($request->all())) {
            return response()->json(['status' => true, 'message' => 'Успешно создан!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Размер не создан.']);}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Resize $resize)
    {
        return response()->json(['status' => true, 'message' => compact('resize')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Resize $resize)
    {
        return response()->json(['status' => true, 'message' => compact('resize')]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resize $resize)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:3',
                'width' => 'integer|min: 2',
                'height' => 'integer|min: 2',
                'resizeMimeType' => 'string|nullable'
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        if($resize->update($request->all())) {
            return response()->json(['status' => true, 'message' => 'Успешно обновлен!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Размер не обновлен.']);}
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resize $resize)
    {
        if($resize->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => false, 'message' => 'Удалить не удалось!']);
    }
}
