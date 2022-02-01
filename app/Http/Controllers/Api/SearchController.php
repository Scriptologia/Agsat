<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search (Request $request){
        $q = $request->q;
        $products = Product::with(['curs', 'category'])->whereNotNull('category_id')
            ->where(function ($query)  use($q) {
                $query->where('name_ru', 'LIKE', "%{$q}%");
                $query->orWhere('name_uk', 'LIKE', "%{$q}%");
                $query->orWhere('description_ru', 'LIKE', "%{$q}%");
                $query->orWhere('description_uk', 'LIKE', "%{$q}%");
                $query->orWhere('text_ru', 'LIKE', "%{$q}%");
                $query->orWhere('text_uk', 'LIKE', "%{$q}%");
                $query->orWhere('price', 'LIKE', "%{$q}%");
                $query->orWhere('skidka', 'LIKE', "%{$q}%");
            })
            ->get();
        $categories = Category::get();
        return response()->json(['status' =>true, 'message' => compact('products', 'categories')]);
    }
}
