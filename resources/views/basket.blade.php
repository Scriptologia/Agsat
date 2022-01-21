@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="basket-products">
            <h1>@lang('text.basket')</h1>
            <div class="basket-products_items" v-cloak v-if="basketPage.products.length">
                <div class="item" v-for="(product, index) in basketPage.products" :key="index">
                    <div class="item_img">
                        <a :href="'/'+product.category.slug+'/'+product.slug">
                            <img :src="product.img_main">
                        </a>
                    </div>
                    <a  :href="'/'+product.category.slug+'/'+product.slug" class="item_name">@{{ product['name_'+lang]}}</a>
                    <div class="item_count">
                        <div class="item_count_form">
                            <input type="number" id="name" min="1" :max="product.count" step="1" autocomplete="off" v-model.number="product.inBasket">
                        </div>
                        <p class="item_count_price">x&nbsp;&nbsp;@{{ product.price_curs }} грн.</p>
                        <h5 class="item_count_all-price">@{{product.price_all }} грн.</h5>
                        <div class="item_count_delete">
                            <i class="fas fa-window-close fa-lg" @click="removeFromBasketPage(product, index)"></i>
                        </div>
                    </div>
                </div>
                <div class="price">
                    <p class="price_label">@lang('text.all-price'): </p>
                    <h3 class="price_price">@{{ basketPage.price }} грн.</h3>
                </div>
            </div>
            <div class="basket-form" v-cloak v-if="basketPage.products.length">
                <div class="one-click-product_form">
                    <div class="form-item">
                        <label for="name">@lang('text.fio'): </label>
                        <input type="text"  id="name" autocomplete="off" v-model.trim="basketPage.person.name" ref="name">
                    </div>
                    <div class="form-item">
                        <label for="phone">@lang('text.phone'): </label>
                        <input type="tel"  id="phone" autocomplete="off" v-model.trim="basketPage.person.phone" ref="phone" placeholder="+3 8(0XX) XXX-XX-XX">
                    </div>
                    <div class="form-item">
                        <label for="city">@lang('text.city'): </label>
                        <input type="text"  id="city" autocomplete="off" v-model.trim="basketPage.person.city" ref="city">
                    </div>
                    <div class="form-item">
                        <label for="street">@lang('text.street'): </label>
                        <input type="text"  id="street" autocomplete="off" v-model.trim="basketPage.person.street" ref="street">
                    </div>
                    <div class="form-item">
                        <label for="post">@lang('text.new-post'): </label>
                        {{--<input type="text"  id="post" autocomplete="off" v-model.trim="basketPage.person.post" ref="post">--}}
                        <select name="post" id="post" v-model="basketPage.person.post" ref="post">
                            <option selected disabled v-if="!basketPage.postArr.length" value="" >@lang('text.no-result')</option>
                            <option selected disabled v-if="basketPage.postArr.length" value="" >@lang('text.searched'): @{{ basketPage.postArr.length }}</option>
                            <option :value="post.DescriptionRu" v-for="(post, index) in basketPage.postArr" :key="index">@{{ post.DescriptionRu }}</option>
                        </select>
                    </div>
                    <div class="errors" v-if="basketPage.errors.length">
                        <ul>
                            <li v-for="(error, index) in basketPage.errors">@{{ error }}</li>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="basket-form_button">
                    <button class="button-green" @click="sendBasketToServer">@lang('text.buy')</button>
                </div></div>
            <div class="basket-empty" v-else v-cloak>
                <h4>@lang('text.basket-empty')</h4>
                <a href="/" type="button"><div class="button">@lang('text.back-to-main')</div></a>
            </div>
        </div>
{{--        @include('blocks.dop-products')--}}
    </div>
</main>
{{--@include('blocks.one-click-buy-modal')--}}
@include('blocks.basket-server-modal')
@include('blocks.basket-server-modal-error')
@endsection
@push('script')
    <script>
            data.sliders.product = {
                img: '',
                currentSlide : 0
            }
            data.product = ''
    </script>
@endpush
