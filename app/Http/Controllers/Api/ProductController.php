<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        $products = Cache::remember('products', 60*60*24, function() {
            return Product::with(['filters', 'service', 'categories'])->where('type','product')->get();
        });
        if(!$products)  return response()->json(['status' => false, 'message' => 'Ошибка получения товаров из базы']);

        return response()->json(compact('products'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $product = Product::create($request->safe()->except(['category_id', 'fields']));
        $product->filters()->attach($validated['fields']);
        $product->categories()->attach($validated['category_id']);

        if($product) {return response()->json(['status' => true, 'message' => 'Успешно создан!']);}
        else {return response()->json(['status' => false, 'message' => 'Товар не создан.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $prod = $product->update($request->safe()->except(['category_id', 'fields']));
        $product->filters()->sync($validated['fields']);
        $product->categories()->sync($validated['category_id']);

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
        $product->filters()->detach();
        $product->categories()->detach();
        if($product->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }

    public function getProductsOfCategory (Category $category){
        $products = $category->products;
        if(!$products)  return response()->json(['status' => false, 'message' => 'Ошибка получения товаров из базы']);

        return response()->json(compact('products'));
    }

    public function  getDopProducts (ProductRequest $request, Product $product) {
        $dopProducts = null;
        if($product->dop_products) $dopProducts = Product::whereIn('id',$product->dop_products)->get();
        if($dopProducts) {
            return response()->json(['status' => true, 'dopProducts' => $dopProducts]);
        }
        return response()->json(['status' => false, 'message' => 'Ошибка получения доп.товаров']);
    }

    public function  getProductsCount (ProductRequest $request) {
        $products = $request->all();

        $products_count = Product::whereIn('id',array_column($products , 'id'))->get();
        if($products_count) {
            return response()->json(['status' => true, 'products' => $products_count]);
        }
        return response()->json(['status' => false, 'message' => 'Ошибка получения доп.товаров']);
    }

    public function  getProduct (ProductRequest $request, Product $product) {
        $prod = $product->with(['curs', 'category', 'service'])->get();
        if($prod) {
            return response()->json(['status' => true, 'product' => $prod]);
        }
        return response()->json(['status' => false, 'message' => 'Ошибка получения доп.товаров']);
    }
}
