<p>Заказ  <b>{{$basket->id}}</b></p>
<i>Имя : </i><b>{{$basket->person['name']}}</b>
<i>Фамилия : </i><b>{{$basket->person['surname']}}</b>
<i>Отчество : </i><b>{{$basket->person['patronymico']}}</b>
@php $phone = '+'.preg_replace('/[^0-9]/', '', $basket->person['phone']); @endphp
<i>Телефон : </i><a href='tel:{{$phone}}'>{{$phone}}</a>
<i>Область : </i><b>{{$basket->person['region']}}</b>
<i>Город : </i><b>{{$basket->person['city']}}</b>
<i>Новая Почта : </i><b>{{$basket->person['post']}}</b>
<i>Дата : </i><b>{{$basket->created_at}}</b>
<i>Число товаров : </i><b>{{count($basket->products)}}</b>
<i>Стоимость : </i><b>{{$basket->price}}</b> грн.
<i>В админку : </i><a href='{{env('APP_URL_ADMINKA')}}'>{{env('APP_URL_ADMINKA')}}</a>