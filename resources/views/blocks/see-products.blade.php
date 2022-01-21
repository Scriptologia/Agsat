    <div class="see-products" v-cloak v-if="seeProducts.length">
    <h3>@lang('text.see-products')</h3>
    <div class="see-products_items">
        <div class="items" :style="{'margin-left': '-' + (200 * sliders.seeProducts.currentSlide) +'px' }">
                <div class="item" v-for="(product, index) in seeProducts" :key="index">
                    <div class="item_img">
                        <a :href="'/'+product.category.slug+'/'+product.slug">
                            <img :src="product.img.find(it => it.main).img" :alt="product['name_'+lang]">
                        </a>
                    </div>
                    <div class="item_name">
                        <a :href="'/'+product.category.slug+'/'+product.slug">@{{product['name_'+lang] }}</a>
                    </div>
                    <div class="item_botton">
                        <div class="price"><h4>@{{parseFloat((product.price * product.curs.curs).toFixed(0)) }} </h4>
                            <span>грн.</span></div>
                        <button class="button-green"
                                @click="addToBasket(product)" v-if="product.count">@lang('text.buy')</button>
                    </div>
                </div>
        </div>
        <div class="arrows left" @click="sliderLeft('seeProducts')">
            <i class="fal fa-chevron-left"></i>
        </div>
        <div class="arrows right" @click="sliderRight('seeProducts')">
            <i class="fal fa-chevron-right"></i>
        </div>
    </div>
</div>
@push('script')
    <script>
        // if (seeProducts.length){
            data.sliders.seeProducts = {
            img: JSON.parse(localStorage.getItem('seeProdutcs')),
            currentSlide : 0
        }
        // }
    </script>
@endpush