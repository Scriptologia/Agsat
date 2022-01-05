<footer>
    <div class="container footer">
        <div class="footer_company">
            <div class="logo"><a href="/"><img src="{{$company->logo}}" alt="logo"></a></div>
            <div class="phone" @click="showContacts"><i class="fas fa-phone fa-rotate-90"></i>&nbsp;<span>{{$company->phones[0]}}</span></div>
            <div class="phone"><a href="mailto:{{env('E_MAIL')}}" target="_blank"><i class="fas fa-envelope"></i>&nbsp;<span>{{env('E_MAIL')}}</span></a></div>
            @if($company->socials)
            <div class="socials">
                    @foreach($company->socials as $social)
                    <a href="{{$social['url']}}" target="_blank"><img src="{{$social['img']}}" alt="{{$social['name']}}"></a></li>
                     @endforeach
            </div>
                @endif
        </div>
        <div class="footer_pages">
            <h3>Разделы сайта:</h3>
            <ul>
                <li><a href="">Доставка и оплата</a></li>
                <li><a href="">Прайс лист</a></li>
                <li><a href="">карта сайта</a></li>
            </ul>
        </div>
    </div>
</footer>