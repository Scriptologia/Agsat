<div class="container" v-if="sliders.main.img" v-cloak>
    <div class="slider_wraper">
        <div class="slider" :style="{'margin-left': '-' + (100 * sliders.main.currentSlide) +'%' }">
                <div class="slider_item" v-for="(item, index) in sliders.main.img">
                    <a :href="item.url">
                    <img :src="item.img">
                    <p>@{{item.text}}</p>
                    {{--<a :href="item.url" class="link">@{{item.text}}</a>--}}
                    </a>
                </div>
        </div>
        <i class="fal fa-chevron-left fa-2x left" @click="sliderLeft()"></i>
        <i class="fal fa-chevron-right fa-2x right" @click="sliderRight()"></i>
    </div>
    </div>
@push('script')
    <script>
        // document.addEventListener("DOMContentLoaded", function () {
            data.autoplaySlider = true;
            data.sliders.main = {currentSlide: 0};
        // })
    </script>
@endpush