<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketRequest;
use App\Models\Basket;
use App\Models\Product;
use App\Jobs\SendZakazToTelegramJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class BasketController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Basket::class, 'basket');
    }
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
//        $validated = $request->validated();
        $basket = Basket::create($request->all());

        if($basket) {
            return response()->json(['status' => true, 'message' => 'Успешно создан!']);
        }
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
//        $validated = $request->validated();
        if($request->is_closed) {
            foreach($request->products as $product) {
                Product::where('id', $product['id'])->update(['count'=> $product['count'] - $product['in_basket']]);
            }
        }

        $basket = $basket->update($request->all());

        if($basket) {return response()->json(['status' => true, 'message' => 'Успешно обновлен!']);}
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
        if($basket->delete())  return response()->json(['status' => true, 'message' => 'Успешно удален!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }

    public function createFromFrontend (BasketRequest $request)
    {
        if($request->ajax()){
            $validated = $request->validated();
            $basket = Basket::create($validated);

            if($basket) {
                dispatch(new SendZakazToTelegramJob($basket));
                return response()->json(['status' => true, 'message' => 'Успешно создан!']);}
            else {return response()->json(['status' => false, 'message' => 'Заказ не создан.']);}
        }
    }
}
