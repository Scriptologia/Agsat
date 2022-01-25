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
                        <label for="name">@lang('text.name'): </label>
                        <input type="text"  id="name" autocomplete="off" v-model.trim="basketPage.person.name" ref="name">
                    </div>
                    <div class="form-item">
                        <label for="surname">@lang('text.surname'): </label>
                        <input type="text"  id="surname" autocomplete="off" v-model.trim="basketPage.person.surname" ref="surname">
                    </div>
                    <div class="form-item">
                        <label for="patronymico">@lang('text.patronymico'): </label>
                        <input type="text"  id="patronymico" autocomplete="off" v-model.trim="basketPage.person.patronymico" ref="patronymico">
                    </div>
                    <div class="form-item">
                        <label for="phone">@lang('text.phone'): </label>
                        <input type="tel"  id="phone" autocomplete="off" v-model.trim="basketPage.person.phone" ref="phone" placeholder="+3 8(0XX) XXX-XX-XX">
                    </div>
                    <div class="form-item">
                        <label for="region">@lang('text.region'): </label>
                        <select name="region" id="region" v-model="basketPage.person.region" ref="region">
                            <option selected disabled v-if="!regions.length" value="" >@lang('text.no-result')</option>
                            <option selected disabled v-if="regions.length" value="" >@lang('text.searched'): @{{ regions.length }}</option>
                            <option :value="post" v-for="(post, index) in regions" :key="index">@{{ post['Description'+(lang == '' || lang == 'ru' ? 'Ru' : '')] }}</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="city">@lang('text.city'): </label>
                        <select name="city" id="city" v-model="basketPage.person.city" ref="city">
                            <option selected disabled v-if="!cities.length" value="" >@lang('text.no-result')</option>
                            <option selected disabled v-if="cities.length" value="" >@lang('text.searched'): @{{ cities.length }}</option>
                            <option :value="post" v-for="(post, index) in cities" :key="index">@{{ post['Description'+(lang == '' || lang == 'ru' ? 'Ru' : '')] }}</option>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="post">@lang('text.new-post'): </label>
                        <select name="post" id="post" v-model="basketPage.person.post" ref="post">
                            <option selected disabled v-if="!posts.length" value="" >@lang('text.no-result')</option>
                            <option selected disabled v-if="posts.length" value="" >@lang('text.searched'): @{{ posts.length }}</option>
                            <option :value="post" v-for="(post, index) in posts" :key="index">@{{ post['Description'+(lang == '' || lang == 'ru' ? 'Ru' : '')] }}</option>
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
                    <button class="button-green" @click="sendBasketToServer">@lang('text.place-order')</button>
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
