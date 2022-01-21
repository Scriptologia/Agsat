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
        $products = Product::with(['curs', 'category'])
            ->where('name_ru', 'LIKE', "%{$q}%")
            ->orWhere('name_uk', 'LIKE', "%{$q}%")
            ->orWhere('description_ru', 'LIKE', "%{$q}%")
            ->orWhere('description_uk', 'LIKE', "%{$q}%")
            ->orWhere('text_ru', 'LIKE', "%{$q}%")
            ->orWhere('text_uk', 'LIKE', "%{$q}%")
            ->orWhere('price', 'LIKE', "%{$q}%")
            ->orWhere('skidka', 'LIKE', "%{$q}%")
            ->get();
        $categories = Category::get();

        return response()->json(['status' =>true, 'message' => compact('products', 'categories')]);
    }
}
