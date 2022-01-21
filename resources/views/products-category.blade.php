@extends('layouts.app')
@section('content')
<main>
    <div class="container">
        <div class="filter-products">
            <div class="filter" ref="filter" v-cloak>
                <i class="fal fa-times" @click="showFilter"></i>
                <div class="filter_content">
                    <div class="item" v-for="(filter, index) in filters" :key="index" v-if="filter.fields.length">
                        <h5 @click="showFilterValue(filter.id)">@{{filter['name_' + lang]}}<i class="fal fa-chevron-down fa-rotate-180"></i></h5>
                        <div :ref="filter.id" class="item_value">@{{ filter.clicked }}
                            <div class="item_value_input" v-for="(field, index) in filter.fields" :key="index">
                                <input type="checkbox" :id="field.id" v-model="field.selected">
                                <label :for="field.id">@{{field['value_'+lang]}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="products">
                <h1>{{$category->{'name_'.App::getLocale()} }}</h1>
                <div class="filter-icon" @click="showFilter">
                    <i class="fas fa-filter"></i>
                    <div v-cloak>@{{ numFilterSelected }}</div>
                </div>
                <div v-if="filteredProducts" v-cloak>
                        <div class="item" v-if="filteredProducts.data.length"
                             v-for="(product, index) in filteredProducts.data" :key="index">
                                    <div class="item_img" v-if="product.img">
                                        <a :href="'/'+category+'/'+product.slug">
                                            <img :src="product.img.find(it => it.main).img" loading="lazy">
                                        </a>
                                    </div>
                                <div class="item_text">
                                    <a :href="'/'+category+'/'+product.slug">
                                        <h4>@{{ product['name_'+lang] }}</h4>
                                        <span>Артикул: @{{product.id}}</span>
                                    </a>
                                    <div class="description" v-html="product['text_'+lang]"></div>
                                </div>
                                <div class="item_price">
                                    <span class="active" v-if="product.count">@lang('text.yes-product')</span>
                                    <span class="passive" v-else>@lang('text.no-product')</span>
                                    <p v-if="product.skidka" class="price">@{{parseFloat((product.price * product.curs.curs).toFixed(0))}} грн</p>
                                    <h4 class="skidka">@{{parseFloat((product.price * product.curs.curs * (100-product.skidka) / 100).toFixed(0))}}
                                        грн</h4>
                                    <button class="green" @click="addToBasket(product)" v-cloak v-if="product.count">@lang('text.buy')</button>
                                </div>
                            </div>
                        <h5  v-if="!filteredProducts.data.length">@lang('text.no-result')</h5>
                        <div  v-if="filteredProducts.links.length -3">
                            <ul class="pagination">
                                    <li class="page-item" v-for="(link, index) in filteredProducts.links" :key="index" :class="{'active': link.active }">
                                        <span v-if="index === 0 && link.active">&laquo;</span>
                                        <a  v-if="index === 0 && !link.active && filteredProducts.currentPage !== 1" @click.prevent="axiosGetFiltered('?page=1')"  :href="link.url" rel="prev" class="page-link">&laquo;</a>

                                          <span v-if="index !== filteredProducts.links.length - 1 && index !== 0 && link.active">@{{ link.label }}</span>
                                          <a v-if="index !== filteredProducts.links.length - 1 && index !== 0 && !link.active" @click.prevent="axiosGetFiltered('?page='+index)"  :href="link.url">@{{  link.label }}</a>

                                    <a v-if="index === filteredProducts.links.length -1 && !link.active && filteredProducts.currentPage !== filteredProducts.total" @click.prevent="axiosGetFiltered('?page='+(filteredProducts.links.length -2))" :href="link.url" rel="next">&raquo;</a>
                                    <span  v-if="index === filteredProducts.links.length -1 && link.active">&raquo;</span>
                                    </li>
                            </ul>
                        </div>
                </div>
                <div v-if="!filteredProducts">
                   @include('blocks.category-products')
                </div>
            </div>
        </div>
    </div>
</main>
@include('blocks.basket-modal')
@endsection
