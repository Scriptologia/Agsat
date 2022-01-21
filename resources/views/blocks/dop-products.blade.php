@if(count($dopProducts))
    <div class="see-products">
    <h3>@lang('text.dop-products')</h3>
    <div class="see-products_items">
        <div class="items" :style="{'margin-left': '-' + (200 * sliders.dopProducts.currentSlide) +'px' }">
            @foreach($dopProducts as $product)
                <div class="item">
                <div class="item_img">
                    <a href="{{'/'.$product->category->slug.'/'.$product->slug}}">
                        <img src="{{$product->img[0]['img']}}" alt="{{$product->{'name_'.App::getLocale()} }}">
                    </a>
                </div>
                <div class="item_name">
                    <a href="{{'/'.$product->category->slug.'/'.$product->slug}}">{{$product->{'name_'.App::getLocale()} }}</a>
                </div>
                <div class="item_botton">
                    <div class="price"><h4>{{round($product->price * $product->curs->curs, 0)}} </h4><span>грн.</span></div>
                    @if($product->count)
                        <button class="button-green" v-cloak @click="addToBasket({{$product}})">@lang('text.buy')</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="arrows left" @click="sliderLeft('dopProducts')">
            <i class="fal fa-chevron-left"></i>
        </div>
        <div class="arrows right" @click="sliderRight('dopProducts')">
            <i class="fal fa-chevron-right"></i>
        </div>
    </div>
</div>
@push('script')
    <script>
            data.sliders.dopProducts = {
            img: @json($dopProducts),
            currentSlide : 0
        }
    </script>
@endpush
@endif