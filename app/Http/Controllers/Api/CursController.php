<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CursRequest;
use App\Models\Curs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CursController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Curs::class, 'curs');
    }
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
    public function store(CursRequest $request)
    {
        $validated = $request->validated();
        if(Curs::create($validated)) {
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
    public function update(CursRequest $request, Curs $cur)
    {
        $validated = $request->validated();
        if($cur->update($validated)) {
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
        if($cur->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => false, 'message' => 'Удалить не удалось!']);
    }
}
