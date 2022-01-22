<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filter;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('categories')->whereNull('category_id')->where('visible', 1)->get();
        return view('home', compact('categories'));
    }

    public function productsOfCategory(Request $request, Category $category)
    {
        $any = $request->any;
        if($any){
            if (strpos($any, "=")) {//запрос от фильтра?
                $queries = array_diff(explode(";", $any), array(""));
                $filt = $this->getFilterParents($category);
                $ids = collect($filt)->flatten()->unique();
                $filters = Filter::with('fields')->whereIn('id', $ids)->get();
                $newUrl = "";
                $arr = [];
                $redir = false;
                foreach ($queries as $query) {
                    $queryArr = explode("=", $query);
                    $filter = $filters->where('slug', $queryArr[0])->first();
                    if ($filter) {
                        $fieldsArr = array_diff(explode("+", $queryArr[1]), array(""));
                        $polStr = "";
                        $arr2 = [];
                        foreach ($fieldsArr as $field) {
                            $pol = $filter->fields->where('slug', $field)->first();
                            if ($pol) {
                                $polStr .= $field . "+";
                                $arr2[] = $field;
                            } else {
                                $redir = true;
                            }
                        }
                        if ($polStr !== "") {
                            $polStr = substr($polStr, 0, -1);
                            $newUrl .= $queryArr[0] . "=" . $polStr . ";";
                            $arr[] = $arr2;
                        }
                    } else {
                        $redir = true;
                    }
                }
                $newUrl = substr($newUrl, 0, -1);
                //редирект на URL с правильным гет-запросом фильтров
                if ($redir) {
                    return redirect($category->slug . '/' . $newUrl);
                }
                //поиск товаров по фильтрам
                $query = $category->products()->with(['category','filters']);
                foreach ($arr as $subArr) {
                    $query = $query->whereHas('filters', function ($q) use ($subArr) {
                        $q->whereIn('slug', $subArr);
                    });
                }
            }
            else { //если нет запроса на фильтрацию значит это запрос на товар
                $product = $category->products()->with('category')->where('slug', $any)->firstOrFail();
                $dop = $product->dop_products ? $product->dop_products : [];
                $dopProducts = Product::whereIn('id',$dop)->get();
                return view('product', ['product'=> $product, 'dopProducts' => $dopProducts]);
            }
            $products = $query;
        }
        else {
            $products = $category->products()->with('category');
        }
        //отправляем на сервер результат
        if ($request->ajax()) {
            return response()->json(['status' => true, 'products' => $products->with('curs')->paginate(10)]);
        } else {
            return view('products-category', ['category' => $category, 'products' => $products->paginate(10)]);
        }
    }

    protected function getFilterParents($item, &$filt = [])
    {
        $filt[] = $item->filters;
        $parent = $item->parentCategory;
        if ($parent) {
            $this->getFilterParents($parent, $filt);
        }
        return $filt;
    }

    public function basket()
    {
        return view('basket');
    }

    public function page(Page $page)
    {
        return view('page', ['page' => $page]);
    }

}
