<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
//        $categories = Category::get();
        if(!$categories)  return response()->json(['status' => false, 'message' => 'Ошибка получения категорий из базы']);

        return response()->json(compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','category:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }

        $validator = Validator::make($request->all(),
            [
                'name_ru' => 'required|min:3',
                'name_uk' => 'required|min:3',
                'slug' => 'required|min:3|unique:products',
                'category_id' => 'integer|nullable',
                'filters' => 'string|nullable',
                'scidka' => 'float|nullable',
                'tags_ru' => 'string|nullable',
                'tags_uk' => 'string|nullable',
                'img' => 'nullable|string'//|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $cat = new Category();
        $cat->name_ru = $request->name_ru;
        $cat->name_uk = $request->name_uk;
        $cat->description_ru = $request->description_ru;
        $cat->description_uk = $request->description_uk;
        $cat->tags_ru = $request->tags_ru;
        $cat->tags_uk = $request->tags_uk;
        $cat->img = $request->img;
        $cat->visible = $request->visible;
        $cat->skidka = $request->skidka;
        $cat->slug = $request->slug;
        $cat->filters = $request->filters;
        $cat->category_id = $request->category_id;

            if($cat->save()) {return response()->json(['status' => true, 'message' => 'Успешно создана!']);}
            else {return response()->json(['status' => false, 'message' => 'Категория не создана.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        if (!auth()->user()->role->permissions->where('slug','category:update' )->first()) {
        return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
        $cat = Category::where('slug' , $category);
        if(!$cat->first()) return response()->json(['status' => false, 'message' => 'Такой категории нет!']);

        $validator = Validator::make($request->all(),
            [
                'name_ru' => 'required|min:3',
                'slug' => 'required|min:3|unique:categories,id,' . $request->id,
                'category_id' => 'nullable',
                'scidka' => 'float|nullable',
                'filters' => 'string|nullable',
                'tags_ru' => 'string|nullable',
                'tags_uk' => 'string|nullable',
                'img' => 'nullable|string'//|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);
        $cat = $cat->first();
        $cat->name_ru = $request->name_ru;
        $cat->name_uk = $request->name_uk;
        $cat->description_ru = $request->description_ru;
        $cat->description_uk = $request->description_uk;
        $cat->tags_ru = $request->tags_ru;
        $cat->tags_uk = $request->tags_uk;
        $cat->img = $request->img;
        $cat->visible = $request->visible;
        $cat->skidka = $request->skidka;
        $cat->slug = $request->slug;
        $cat->filters = $request->filters;
        $cat->category_id = $request->category_id;

        if($cat->save()) {return response()->json(['status' => true, 'message' => 'Успешно обновлена!']);}
        else {return response()->json(['status' => false, 'message' => 'Категория не обнавлена.']);}
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (!auth()->user()->role->permissions->where('slug','category:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        if($category->delete())  return response()->json(['status' => true, 'message' => 'Успешно удалена!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }
}
