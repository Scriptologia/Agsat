<footer>
    <div class="container footer">
        <div class="footer_company">
            <div class="logo"><a href="/"><img src="{{$company->logo}}" alt="logo"></a></div>
            <div class="phone" @click="showModal('contacts')"><i class="fas fa-phone fa-rotate-90"></i>&nbsp;<span>{{$company->phones[0]}}</span></div>
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
            <h5>Разделы сайта:</h5>
            <ul>
                @foreach($pages as $page)
                    <li><a href="{{route('page',$page)}}">{{$page->{'name_'.App::getLocale() } }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>