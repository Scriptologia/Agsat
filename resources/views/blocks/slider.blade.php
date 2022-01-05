<div class="container" v-if="sliders.length">
    <div class="slider_wraper">
        <div class="slider" :style="{'margin-left': '-' + (100 * currentSlide) +'%' }">
                <div class="slider_item" v-for="(item, index) in sliders">
                    <img :src="item.img">
                    <a :href="item.url">@{{item.text}}</a>
                </div>
        </div>
        <i class="fal fa-chevron-left fa-2x left" @click="sliderLeft"></i>
        <i class="fal fa-chevron-right fa-2x right" @click="sliderRight"></i>
    </div>
    </div>
{{--@endif@if(count($sliders))--}}
    {{--<div class="container">--}}
    {{--<div class="slider_wraper">--}}
        {{--<div class="slider">--}}
            {{--@foreach($sliders as $item)--}}
                {{--<div class="slider_item">--}}
                    {{--<img src="{{$item['img']}}">--}}
                    {{--<a href="{{$item['url']}}"><p>{{$item['text']}}</p></a>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
{{--@endif--}}