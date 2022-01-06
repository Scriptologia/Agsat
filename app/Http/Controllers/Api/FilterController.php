<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = Filter::whereNull('filter_id')->with('fields')->get();
        if(!$filters)  return response()->json(['status' => false, 'message' => 'Ошибка получения фильтров из базы']);

        return response()->json(compact('filters'));
    }
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','filter:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
            [
                'name_ru' => 'required|min:3',
                'name_uk' => 'required|min:3',
                'slug' => 'required|min:3|unique:filters',
                'filter_id' => 'string|nullable',
                'fields' => 'array'
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $filter = new Filter();
        $filter->name_ru = $request->name_ru;
        $filter->name_uk = $request->name_uk;
        $filter->visible = $request->visible;
        $filter->slug = $request->slug;
        if($filter->save()) {
            $fields= $request->fields;
            if($fields) {
                $validator = Validator::make($fields,
                    [
                        'fields.*.slug' => 'required|min:3|unique:filters',
                        'fields.*.value_ru' => 'required|min:3|unique:filters',
                        'fields.*.value_uk' => 'required|min:3|unique:filters',
                    ]
                );
                if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

                $filter_id= Filter::where('slug' , $request->slug)->first()->id;
                foreach($fields as $field) {
                    $filter = new Filter();
                    $filter->filter_id = $filter_id;
                    $filter->slug = $field['slug'];
                    $filter->value_ru = $field['value_ru'];
                    $filter->value_uk = $field['value_uk'];
                    if(!$filter->save()) return response()->json(['status' => false, 'message' => 'Поле фильтра '.$field->value_ru.' не создано.']);
                }
            }
            return response()->json(['status' => true, 'message' => 'Успешно создан!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Фильтр не создана.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filter $filter)
    {
        if (!auth()->user()->role->permissions->where('slug','filter:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
//        $filter = Filter::where('slug' , $filter)->first();
//        if(!$filter) return response()->json(['status' => false, 'message' => 'Такого фильтра нет!']);

        $validator = Validator::make($request->all(),
            [
                'name_ru' => 'required|min:3',
                'slug' => ['required', 'min:3',Rule::unique('filters')->ignore($filter)],
                'filter_id' => 'nullable',
                'fields' => 'array'
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $filter->name_ru = $request->name_ru;
        $filter->name_uk = $request->name_uk;
        $filter->visible = $request->visible;
        $filter->slug = $request->slug;

        if($filter->save()) {
            $fields= $request->fields;
            if($fields) {
                $validator = Validator::make($fields,
                    [
                        'fields.*.slug' => 'required|min:3',
                        'fields.*.value_ru' => 'required|min:3',
                        'fields.*.value_uk' => 'required|min:3',
                    ]
                );
                if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

                $filter_id= $filter->id;
                foreach($fields as $field) {
                    $add = $field['id'];
                    $filter = Filter::where('slug', $field['slug'])->first();
                    if($filter && $filter->id !== $add) return response()->json(['status' => false, 'message' => 'Slug '.$filter->slug.' занят']);
                    if($filter) {
                        $filter->slug = $field['slug'];
                        $filter->value_ru = $field['value_ru'];
                        $filter->value_uk = $field['value_uk'];
                    }
                    else {
                        $filter = new Filter();
                        $filter->filter_id = $filter_id;
                        $filter->slug = $field['slug'];
                        $filter->value_ru = $field['value_ru'];
                        $filter->value_uk = $field['value_uk'];
                    }
                    if(!$filter->save()) return response()->json(['status' => false, 'message' => 'Поле фильтра '.$field->value_ru.' не создано.']);
                }
            }
            return response()->json(['status' => true, 'message' => 'Успешно обновлен!']);
        }
        else {return response()->json(['status' => false, 'message' => 'Фильтр не обновлен.']);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filter $filter)
    {
        if (!auth()->user()->role->permissions->where('slug','filter:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        if($filter->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }
}
