<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::first();
        if(!$company)  return response()->json(['status' => false, 'message' => 'Ошибка получения из базы']);

        return response()->json(compact('company'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','company:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
            [
                'text_ru' => 'string|nullable',
                'text_uk' => 'string|nullable',
                'phones' => 'array|nullable',
                'socials' => 'array|nullable',
                'time' => 'array|nullable',
                'name' => 'required|string',
                'logo' => 'required|string',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        if(Company::create($request->all())) {return response()->json(['status' => true, 'message' => 'Успешно создана!']);}
        else {return response()->json(['status' => false, 'message' => 'Не создана.']);}
    }    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if (!auth()->user()->role->permissions->where('slug','company:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
        $validator = Validator::make($request->all(),
            [
                'text_ru' => 'string|nullable',
                'text_uk' => 'string|nullable',
                'phones' => 'array|nullable',
                'socials' => 'array|nullable',
                'time' => 'array|nullable',
                'name' => 'required|string',
                'logo' => 'required|string',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        if($company->update($request->all())) {return response()->json(['status' => true, 'message' => 'Успешно обновлен!']);}
        else {return response()->json(['status' => false, 'message' => 'Товар не обнавлен.']);}
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (!auth()->user()->role->permissions->where('slug','company:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        if($company->delete())  return response()->json(['status' => true, 'message' => 'Успешно удалена!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }
}
