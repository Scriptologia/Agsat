@extends('layouts.app')
@section('content')
<main>
    @include('blocks.slider')
    <div class="container">
        <h1>@lang('text.home_header')</h1>
        <div class="category">
        @foreach($categories as $mainCategory)
        @foreach($mainCategory->categories as $category)
            <div class="category_item">
                <a href="{{$category->slug}}">
                    <img src="{{$category->img}}" alt="" loading="lazy">
                    <h5>{{$category->{'name_'.App::getLocale()} }}</h5>
                </a>
                <p>{{$category->{'description_'.App::getLocale()} }}</p>
            </div>
         @endforeach
         @endforeach
        </div>
    </div>
</main>
@endsection