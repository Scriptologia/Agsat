<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $baskets = Basket::orderBy('is_closed', 'ASC')->get();
        if(!$baskets)  return response()->json(['status' => false, 'message' => 'Ошибка получения заказов из базы']);

        return response()->json(compact('baskets'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','basket:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
            [
                'products' => 'array|required',
                'person' => 'array|required',
                'person.name' => 'string|required',
                'person.phone' => 'string|required',
                'person.city' => 'string|required',
                'person.street' => 'string|required',
                'person.post' => 'string|required',
                'is_closed' => 'boolean|nullable',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $basket = new Basket();
        $basket->products = $request->products;
        $basket->person = $request->person;
        $basket->price = $request->price;
        $basket->is_closed = $request->is_closed;

        $prod = $basket->save();

        if($prod) {return response()->json(['status' => true, 'message' => 'Успешно создан!']);}
        else {return response()->json(['status' => false, 'message' => 'Заказ не создан.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        if (!auth()->user()->role->permissions->where('slug','basket:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }
        $validator = Validator::make($request->all(),
            [
                'products' => 'array|required',
                'person' => 'array|required',
                'person.name' => 'string|required',
                'person.phone' => 'string|required',
                'person.city' => 'string|required',
                'person.street' => 'string|required',
                'person.post' => 'string|required',
                'is_closed' => 'boolean|nullable',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $basket->products = $request->products;
        $basket->person = $request->person;
        $basket->price = $request->price;
        $basket->is_closed = $request->is_closed;
        if($request->is_closed) {
            foreach($request->products as $product) {
                Product::where('id', $product['id'])->update(['count'=> $product['count'] - $product['in_basket']]);
            }
        }

        $prod = $basket->save();

        if($prod) {return response()->json(['status' => true, 'message' => 'Успешно обновлен!']);}
        else {return response()->json(['status' => false, 'message' => 'Заказ не обнавлен.']);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Basket $basket)
    {
        if (!auth()->user()->role->permissions->where('slug','basket:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }

        if($basket->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }

    public function createFromFrontend (Request $request)
    {
        if($request->ajax()){
            $validator = Validator::make($request->all(),
                [
                    'products' => 'array|required',
                    'person' => 'array|required',
                    'person.name' => 'string|required',
                    'person.surname' => 'string|required',
                    'person.patronymico' => 'string|required',
                    'person.phone' => 'string|required',
                    'person.city' => 'string|required',
                    'person.region' => 'string|required',
                    'person.post' => 'string|required',
                    'is_closed' => 'boolean|nullable',
                ]
            );
            if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

            $basket = new Basket();
            $basket->products = $request->products;
            $basket->person = $request->person;
            $basket->price = $request->price;
            $basket->is_closed = $request->is_closed;

            $prod = $basket->save();

            if($prod) {return response()->json(['status' => true, 'message' => 'Успешно создан!']);}
            else {return response()->json(['status' => false, 'message' => 'Заказ не создан.']);}
        }
    }
}
