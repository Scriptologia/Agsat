<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_DOMAIN') }} {{isset($product) ? ' | '. $product->{'name_'.App::getLocale()} :  '' }}{{!isset($categories) && isset($category) ?' | '. $category->{'name_'.App::getLocale()} :  '' }}{{isset($page) ?' | '. $page->{'name_'.App::getLocale()} :  '' }}</title>
    <meta name="Keywords" content="{{isset($product) && !is_null($product->{'tags_'.App::getLocale()}) ?  implode(',',$product->{'tags_'.App::getLocale()}) :  '' }}{{isset($category) && !is_null($category->{'tags_'.App::getLocale()}) ?'   '. implode(',',$category->{'tags_'.App::getLocale()}) :  '' }}" />
    <meta name="Description" content="{{isset($product) ? $product->{'description_'.App::getLocale()} :  '' }}{{isset($category) ?'  '. $category->{'description_'.App::getLocale()} :  '' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="shortcut icon" href="{{asset('logo-32.png')}}" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome-pro-5.12.0/css/all.css')}}">
    @php
        $arr = explode('/',request()->path());
    if(in_array($arr[0],['ru', 'uk'] )){ array_splice($arr, 0,1);}
    $get = implode('/',$arr);
    @endphp
    <link rel="canonical" href="{{env('APP_URL')}}/{{$get}}" />
    <link
            rel="alternate"
            hreflang="uk"
            href="{{env('APP_URL')}}/uk/{{$get}}"
    />
    <link
            rel="alternate"
            hreflang="x-default"
            href="{{env('APP_URL')}}/{{$get}}"
    />
    <link
            rel="alternate"
            hreflang="ru"
            href="{{env('APP_URL')}}/{{$get}}"
    />
</head>
<body>
<div id="app">
    @include('blocks.header')
    @include('blocks.menu')

    @yield('content')

    @include('blocks.footer')
</div>
<script >
    let data = {
        filters:[],
        moreShow:{
            text: ["@lang('text.more')", "@lang('text.more_hide')"]
        },
        query:"",
        apiKeyNovaPochta :'480580809b2620f3e6c49c024b0d3354',
        currentPage:"",
        megaMenu:false,
        currentProductBasket: null,
        filteredProducts : "",
        categories:[],
        basket:{},
        basketPage:{
            products:[],
            price:0,
            errors:[],
            person: {name:'',patronymico:'',surname:'', phone:'', city:{}, region:{}, post:{}}
        },
        regions:[],
        cities:[],
        posts:[],
        category:'',
        children_categories: [],
        showMegaMenu: false,
        search: '',
        searchResult: [],
        sliders: {},
        sliderInterval:3000,
        lang:'{{App::getLocale()}}',
        arrLang:['','ru','uk'],
        interval: '',
        product:null,
        noLinks: [
            'basket'
        ],
        domain: ''
    }
</script>
@stack('script')
{{--<script src="{{asset('js/vue.min.js')}}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{asset('/js/app.js')}}"></script>
</body>
</html>
