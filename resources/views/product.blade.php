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
                        <h1 class="price" v-cloak>@{{ parseFloat((product.price * product.curs.curs * (100-product.skidka) / 100).toFixed(0)) + parseFloat((product.isService * (product.service ? product.service.curs.curs * product.service.price : 0)).toFixed(0)) }} грн.
{{--                        <h1 class="price">{{round($product->price * $product->curs->curs * (100-$product->skidka) / 100, 0)}} грн.--}}
                            @if($product->count)
                                <span class="active"><i class="fal fa-check-square"></i> @lang('text.yes-product')</span>
                            @else
                                <span class="passive">@lang('text.no-product')</span>
                            @endif
                        </h1>
                        @if($product->skidka > 0)
                            <h3 class="full-price">{{round($product->price * $product->curs->curs, 0)}} грн.</h3>
                        @endif
                        @include('blocks.service')
                        @if($product->count)
                            <button class="button-green" v-cloak @click="addToBasket(product)">@lang('text.buy')</button>
                            <button class="button-green_light" v-cloak @click="showModal('oneclickbuymodal')">@lang('text.buy_one_click')</button>
                        @endif
                    </div>
                    {{--@include('blocks.product-info')--}}
                </div>
                <div class="main_top_description">
                    {!! $product->{'text_'.App::getLocale()} !!}
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
            data.product = {...@json($product), isService:0, inBasket:1, person: {name:'',surname:'',patronymico:'', phone:'', city:{}, region:{}, post:{}}, errors:[] }
    </script>
@endpush
