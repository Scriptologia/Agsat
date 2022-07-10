<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::get();
        if(!$services)  return response()->json(['status' => false, 'message' => 'Ошибка получения услуг из базы']);

        return response()->json(compact('services'));
    }

    public function store(ServiceRequest $request)
    {
        $validated = $request->validated();

        if(Service::create($validated)) {return response()->json(['status' => true, 'message' => 'Успешно созданf!']);}
        else {return response()->json(['status' => false, 'message' => 'Услуга не создан.']);}
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $validated = $request->validated();
        if($service->update($validated)) {return response()->json(['status' => true, 'message' => 'Успешно обновлена!']);}
        else {return response()->json(['status' => false, 'message' => 'Услуга не обнавлен.']);}
    }

    public function destroy(Service $service)
    {
        if($service->delete())  return response()->json(['status' => true, 'message' => 'Успешно удалена!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }
}
