<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Basket extends Model
{
    use HasFactory;
    protected $casts = [
        'products' => 'array',
        'price' => 'float',
        'person' => 'array',
        'is_closed' => 'boolean',
    ];
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::created(function ($item) {
            $text = "";
            $text = $text."Заказ  <b>".$item->id."</b> \n \n ";
            $text = $text."<i>ФИО :</i><b>".$item->person['name']."</b> \n ";
            $phone = '+'.preg_replace('/[^0-9]/', '', $item->person['phone']);
            $text = $text."<i>Телефон :</i> <a href='tel:".$phone."'>".$phone."</a> \n ";
            $text = $text."<i>Город :</i> <b>".$item->person['city']."</b> \n";
            $text = $text."<i>Улица :</i> <b>".$item->person['street']."</b> \n";
            $text = $text."<i>Новая Почта :</i> <b>".$item->person['post']."</b> \n \n";
            $text = $text."<i>Дата :</i> <b>".$item->created_at."</b> \n \n";
            $text = $text."<i>Число товаров :</i> <b>".count($item->products)."</b> \n \n";
            $text = $text."<i>Стоимость :</i> <b>".$item->price."</b> \n";
            $text = $text."<i>В админку :</i> <a href='".env('APP_URL_ADMINKA')."'>".env('APP_URL_ADMINKA')."</a>";
            $params = array(
                'chat_id' => env('TELEGRAM_BOT_CHAT_ID'), // id получателя сообщения
                'text' => $text, // текст сообщения
                'parse_mode' => 'HTML', // режим отображения сообщения, не обязательный параметр
            );
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage'); // адрес api телеграмм
            curl_setopt($curl, CURLOPT_POST, true); // отправка данных методом POST
            curl_setopt($curl, CURLOPT_TIMEOUT, 10); // максимальное время выполнения запроса
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params); // параметры запроса
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//асинхронный запрос, чтобы не получать ответ от телеги, который мешает получению success(в контроллере)
            curl_exec($curl); // запрос к api
            curl_close($curl);
        });
    }

    public function setProductsAttribute($value)
    {
        $this->attributes['products'] = $value != []?  json_encode($value) : null;
    }
    public function setPersonAttribute($value)
    {
        $this->attributes['person'] = $value != []?  json_encode($value) : null;
    }
    public function setIsClosedAttribute($value)
    {
        $this->attributes['is_closed'] = $value ? 1  : 0;
    }
}
