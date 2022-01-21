@if (count($products))
    @foreach($products as $product)
        <div class="item">
            @if($product->img)
                <div class="item_img">
                    <a href="/{{$category->slug}}/{{$product->slug}}">
                        <img src="{{$product->img[0]['img']}}" loading="lazy">
                    </a>
                </div>
            @endif
            <div class="item_text">
                <a href="/{{$category->slug}}/{{$product->slug}}">
                    <h4>{{$product->{'name_'.App::getLocale()} }}</h4>
                    <span>@lang('text.articul'): {{$product->id}}</span>
                </a>
                <div class="description">{!! $product->{'text_'.App::getLocale()} !!}</div>
            </div>
            <div class="item_price">
                @if($product->count)
                    <span class="active">@lang('text.yes-product')</span>
                @else
                    <span class="passive">@lang('text.no-product')</span>
                @endif
                @if($product->skidka > 0)
                    <p class="price">{{round($product->price * $product->curs->curs, 0)}} грн</p>
                @endif
                <h4 class="skidka">{{round($product->price * $product->curs->curs * (100-$product->skidka) / 100, 0)}} грн</h4>
                    @if($product->count)
                        <button class="green" @click="addToBasket({{$product}})" v-cloak>@lang('text.buy')</button>
                    @endif
            </div>
        </div>
    @endforeach
@else
    <h5>@lang('text.no-result')</h5>
@endif
    {{$products->links()}}