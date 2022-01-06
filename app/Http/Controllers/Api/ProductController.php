<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('filters')->where('type','product')->get();
        if(!$products)  return response()->json(['status' => false, 'message' => 'Ошибка получения товаров из базы']);

        return response()->json(compact('products'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','product:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
            [
                'name_ru' => 'required|min:3',
                'name_uk' => 'required|min:3',
                'slug' => 'required|min:3|unique:products',
                'filters' => 'array|nullable',
                'scidka' => 'numeric|nullable',
                'price' => 'numeric|nullable',
                'category_id' => 'integer|nullable',
                'tags_ru' => 'array|nullable',
                'tags_uk' => 'array|nullable',
                'text_ru' => 'string|nullable',
                'text_uk' => 'string|nullable',
                'description_ru' => 'string|nullable',
                'description_uk' => 'string|nullable',
                'visible' => 'boolean|nullable',
                'curs_id' => 'integer|nullable',
                'img' => 'nullable|array'//|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $product = new Product();
        $product->name_ru = $request->name_ru;
        $product->name_uk = $request->name_uk;
        $product->description_ru = $request->description_ru;
        $product->description_uk = $request->description_uk;
        $product->text_ru = $request->text_ru;
        $product->text_uk = $request->text_uk;
        $product->tags_ru = $request->tags_ru;
        $product->tags_uk = $request->tags_uk;
        $product->img = $request->img;
        $product->visible = $request->visible;
        $product->skidka = $request->skidka;
        $product->slug = $request->slug;
        $product->curs_id = $request->curs_id;
        $product->count = $request->count;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->category_id = $request->category_id;

        $prod = $product->save();
        $product->filters()->attach($request->fields);

        if($prod) {return response()->json(['status' => true, 'message' => 'Успешно создан!']);}
        else {return response()->json(['status' => false, 'message' => 'Товар не создан.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if (!auth()->user()->role->permissions->where('slug','product:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
//        $cat = Category::where('slug' , $product);
//        if(!$product) return response()->json(['status' => false, 'message' => 'Такой категории нет!']);

        $validator = Validator::make($request->all(),
            [
                'name_ru' => 'required|min:3',
                'name_uk' => 'required|min:3',
                'slug' => ['required', Rule::unique('products')->ignore($product)],
                'filters' => 'string|nullable',
                'scidka' => 'numeric|nullable',
                'price' => 'numeric|nullable',
                'category_id' => 'integer|nullable',
                'tags_ru' => 'array|nullable',
                'tags_uk' => 'array|nullable',
                'text_ru' => 'string|nullable',
                'text_uk' => 'string|nullable',
                'description_ru' => 'string|nullable',
                'description_uk' => 'string|nullable',
                'visible' => 'boolean|nullable',
                'curs_id' => 'integer|nullable',
                'img' => 'nullable|array'//|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $product->name_ru = $request->name_ru;
        $product->name_uk = $request->name_uk;
        $product->description_ru = $request->description_ru;
        $product->description_uk = $request->description_uk;
        $product->text_ru = $request->text_ru;
        $product->text_uk = $request->text_uk;
        $product->tags_ru = $request->tags_ru;
        $product->tags_uk = $request->tags_uk;
        $product->img = $request->img;
        $product->visible = $request->visible;
        $product->skidka = $request->skidka;
        $product->slug = $request->slug;
        $product->curs_id = $request->curs_id;
        $product->count = $request->count;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->category_id = $request->category_id;

        $prod = $product->save();
        $product->filters()->sync($request->fields);

        if($prod) {return response()->json(['status' => true, 'message' => 'Успешно обновлен!']);}
        else {return response()->json(['status' => false, 'message' => 'Товар не обнавлен.']);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (!auth()->user()->role->permissions->where('slug','product:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        $product->filters()->detach();
        if($product->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }
}
