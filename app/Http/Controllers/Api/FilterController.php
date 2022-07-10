<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Models\Category;
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
    public function store(FilterRequest $request)
    {
        $validated = $request->validated();
        if(Filter::create($request->safe()->except(['filter_id', 'fields']))) {
            $fields= $validated['fields'];
            if($fields) {
                $filter_id= Filter::where('slug' , $validated['slug'])->first()->id;
                foreach($fields as $field) {
                    $field['filter_id'] = $filter_id;
                    if(!Filter::create($field)) return response()->json(['status' => false, 'message' => 'Поле фильтра '.$field->value_ru.' не создано.']);
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
    public function update(FilterRequest $request, Filter $filter)
    {
        if($filter->update($request->safe()->except(['filter_id', 'fields']))) {
            $fields= $request->fields;
            if($fields) {
                $filter_id= $filter->id;
                foreach($fields as $field) {
                    $filter = Filter::where('slug', $field['slug'])->first();
                    if($filter && $filter->id !== $field['id']) return response()->json(['status' => false, 'message' => 'Slug '.$filter->slug.' занят']);
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
        if($filter->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }

    public function getFilters (FilterRequest $request, Category $category){
        $filt = $this->getFilterParents($category);
        $ids = collect($filt)->flatten()->unique();
        $filters = Filter::with('fields')->whereIn('id', $ids)->get();
        return response()->json(['status' => true, 'message' => $filters]);
    }
    protected function getFilterParents ($item, &$filt = []) {
        $filt[] = $item->filters;
        $parent = $item->parentCategory;
        if($parent) { $this->getFilterParents($parent, $filt);}
        return $filt;
    }
}
