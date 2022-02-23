@extends('layouts.app')
@section('content')
<main>
    @include('blocks.slider')
    <div class="container">
        <h1>@lang('text.contacts'):</h1>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1373.263707233694!2d30.72378892187289!3d46.49766945970768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c631dd78bdfc59%3A0xe6bc7851c98a1a2e!2ssmart-tele.com.ua!5e0!3m2!1sru!2sua!4v1644431540020!5m2!1sru!2sua" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="contacts">
            <div class="contacts_adress">
                <h4>@lang('text.adress'):</h4>
                <p><i class="fal fa-map-marker"></i> @lang('text.full-adress')</p>
            </div>
            <div class="contacts_contacts">
                <h4>@lang('text.contacts'):</h4>
                <ul>
                    @foreach($company->phones as $phone)
                    <li><i class="fas fa-phone fa-rotate-90"></i> {{$phone}}</li>
                    @endforeach
                    <li><a href="mailto:smart.tele.ua@gmail.com"><i class="fal fa-envelope"></i> smart.tele.ua@gmail.com</a></li>
                </ul>
            </div>
            <div class="contacts_grafik">
                <h4>@lang('text.grafic_raboty'):</h4>
                <ul>
                    <li>@lang('text.week.mn') <span>@lang('text.free')</span></li>
                    <li>@lang('text.week.tг') <span>9:00 - 16:00</span></li>
                    <li>@lang('text.week.we') <span>9:00 - 16:00</span></li>
                    <li>@lang('text.week.th') <span>9:00 - 16:00</span></li>
                    <li>@lang('text.week.fr') <span>9:00 - 16:00</span></li>
                    <li>@lang('text.week.sa') <span>9:00 - 16:00</span></li>
                    <li>@lang('text.week.su') <span>9:00 - 16:00</span></li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection
