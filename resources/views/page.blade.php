@extends('layouts.app')
@section('content')
<main>
{{--    @include('blocks.slider')--}}
    <div class="container">
        <h1>{{$page->{'name_'.App::getLocale()} }}</h1>
        <div class="page">
            {!! $page->{'text_'.App::getLocale()} !!}
        </div>
    </div>
</main>
@endsection
