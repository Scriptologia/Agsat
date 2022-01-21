@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="product">
            <div class="images">
                <img src="{{(($product->img)[0])['img']}}" alt="{{$product->{'name_'.App::getLocale()} }}" loading="lazy" ref="mainImg">
                @if(count($product->img) > 1)
                <div class="slider">
                    <div class="slider_items" :style="{'margin-left': '-' + (33.33 * sliders.product.currentSlide) +'%' }">
                            @foreach($product->img  as $img)
                                <div class="slider_items_img">
                                    <img src="{{$img['img']}}" alt="{{$product->{'name_'.App::getLocale()} }}"  loading="lazy" @click="makeMainImg">
                                </div>
                            @endforeach
                    </div>
                        <div class="arrows left" @click="sliderLeft('product')">
                            <i class="fal fa-chevron-left"></i>
                        </div>
                        <div class="arrows right" @click="sliderRight('product')">
                            <i class="fal fa-chevron-right"></i>
                        </div>
                </div>
                @endif
            </div>
            <div class="main">
                <h1>{{$product->{'name_'.App::getLocale()} }}</h1>
                <hr>
                <div class="main_top">
                    <div class="main_top_left">
                        <span class="articul">@lang('text.articul') {{$product->id}}</span>
                        <h1 class="price">{{round($product->price * $product->curs->curs * (100-$product->skidka) / 100, 0)}} грн.
                            @if($product->count)
                                <span class="active"><i class="fal fa-check-square"></i> @lang('text.yes-product')</span>
                            @else
                                <span class="passive">@lang('text.no-product')</span>
                            @endif
                        </h1>
                        @if($product->skidka > 0)
                            <h3 class="full-price">{{round($product->price * $product->curs->curs, 0)}} грн.</h3>
                        @endif
                        <div class="proshivka" v-cloak>
                            <h5>Прошивка (обновление ПО) + 100 грн</h5>
                            <div class="opened" ref="more"  :class="{'max-height': moreShow.more }">
                                <p>Обновление программного обеспечения на {{$product->{'name_'.App::getLocale()} }} до последней актуальной версии,  загрузка списка каналов на 4 популярных спутника: </p>
                                <ul>
                                    <li>Eutelsat Hot Bird 13 B/C/E (13°E); </li>
                                    <li>SES 5/Astra 4A (4.9°E);</li>
                                    <li>Amos 2/3/7;</li>
                                    <li>ABC 75°W;</li>
                                </ul>
                                <p>Подготовка списков каналов под другие фаворитные группы с украинскими каналами обговаривается дополнительно.</p>
                            </div>
                            <a href="#" class="more" @click.prevent="more('more')">@lang('text.more')</a>
                        </div>
                        @if($product->count)
                            <button class="button-green" v-cloak @click="addToBasket({{$product}})">@lang('text.buy')</button>
                            <button class="button-green_light" v-cloak @click="showModal('oneclickbuymodal')">@lang('text.buy_one_click')</button>
                        @endif
                    </div>
                    <div class="main_top_right">
                        <div style="width:300px;height:100px;"></div>
                    </div>
                </div>
                <div class="main_top_description">
                    {{$product->{'description_'.App::getLocale()} }}
                </div>
            </div>
        </div>
        @include('blocks.dop-products')
        <br>
        @include('blocks.see-products')
    </div>
</main>
@include('blocks.one-click-buy-modal')
@include('blocks.basket-server-modal')
@include('blocks.basket-server-modal-error')
@include('blocks.basket-modal')
@endsection
@push('script')
    <script>
            data.sliders.product = {
                img: @json($product->img),
                currentSlide : 0
            }
            data.product = {...@json($product), inBasket:1, postArr:[], person: {name:'', phone:'', city:'', street:'', post:''}, errors:[] }
    </script>
@endpush
