@extends('layouts.app')
@section('content')
<main>
    @include('blocks.slider')
    <div class="container">
        <h1>Оборудование для цифрового телевидения</h1>
        <div class="category">
        @foreach($categories as $category)
            <div class="category_item">
                <a href="{{$category->slug}}">
                    <img src="{{$category->img}}" alt=""><h4>{{$category->{'name_'.App::getLocale()} }}</h4>
                </a>
                <p>{{$category->{'description_'.App::getLocale()} }}</p>
            </div>
         @endforeach
        </div>
    </div>
</main>
@endsection
