@if($product->service)
    <div class="proshivka" v-cloak>
        <div class="form-item h5" v-if="product.service">
            <input type="checkbox" id="service" v-model="product.isService">
            <label for="service">@{{ product.service['name_'+lang] }} + @{{parseFloat((product.service.curs.curs * product.service.price).toFixed(0))}} грн.</label>
        </div>
    <div class="opened" ref="more"  :class="{'max-height': moreShow.more }">
       {!! $product->service->{'text_'.App::getLocale()} !!}
    </div>
    <a href="#" class="more" @click.prevent="more('more')">@lang('text.more')</a>
</div>
@endif