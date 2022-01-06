<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- <meta http-equiv="x-ua-compatible" content="IE=edge"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{--@csrf--}}
    <title>Спутниковое телевидение от интернет-магазина Agsat.com.ua. Оборудования для приема спутникового тв.</title>
    <meta name="Keywords" content="спутниковое телевидение, спутниковое тв, оборудование для приема спутникового телевидения – спутниковые антенны, ресиверы, установка спутникового телевидения, спутниковое тв с абонплатой и без абонплаты" />
    <meta name="Description" content="Оборудование для приема спутникового телевидения: спутниковые антенны, спутниковые ресиверы; установка спутникового тв." />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="canonical" href="https://www.agsat.com.ua/" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome-pro-5.12.0/css/all.css')}}">
    <!-- rss -->
    <link
            rel="alternate"
            type="application/rss+xml"
            title="RSS &mdash; Agsat.com.ua"
            href="https://www.agsat.com.ua/info/rss/"
    />
    <meta property="og:image" content="/wa-apps/shop/themes/agsat/img/logo.svg" />
    <link
            rel="alternate"
            hreflang="uk"
            href="https://www.agsat.com.ua/ua/"
    />
    <link
            rel="alternate"
            hreflang="x-default"
            href="https://www.agsat.com.ua/ua/"
    />
    <link
            rel="alternate"
            hreflang="ru"
            href="https://www.agsat.com.ua/"
    />
    <meta name="theme-color" content="#e0e3da" />
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
        megaMenu:false,
        categories:[],
        children_categories: [],
        showMegaMenu: false,
        search: '',
        searchResult: [],
        sliders: [],
        currentSlide: 0,
        sliderInterval:2000,
        lang:'{{App::getLocale()}}'
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{asset('/js/app.js')}}"></script>
</body>
</html>
