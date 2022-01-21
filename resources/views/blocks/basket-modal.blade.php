<div class="layout_modal" ref="basketmodal" @click.self="hideModal('basketmodal')" v-cloak>
    <div class="modal_content basket-modal" v-if="currentProductBasket">
        <i class="fal fa-times" @click="hideModal('basketmodal')"></i>
        <h3>@lang('text.product_succes_basket')</h3>
        <hr>
        <div class="product-in-basket">
            <img :src="currentProductBasket.img.find(it => it.main).img">
            <div class="product-in-basket_left">
                <h5 class="name">@{{ currentProductBasket['name_'+lang] }}</h5>
                <p class="price">@{{ parseFloat((currentProductBasket.price * currentProductBasket.curs.curs * (100-currentProductBasket.skidka) / 100).toFixed(0)) }} грн.</p>
            </div>
        </div>
        <br>
        <div class="product-in-basket_buttons">
            <button class="cansel" @click="hideModal('basketmodal')">@lang('text.bact_to_buy')</button>
            <a class="to-basket" href="{{route('basket')}}">@lang('text.go_to_basket')</a>
        </div>
    </div>
</div>