<header class="">
    <div class="header_banner">
        <div class="header_banner_item">
            тут расписание работы и т.п...
        </div>
    </div>
   <nav>
       <div class="container nav">
       <i class="fal fa-bars fa-lg nav_burger" @click="showNavMenu"></i>
           <div class="nav_menu" ref="nav_menu">
               <i class="fal fa-times" @click="hideNavMenu"></i>
               <ul class="nav_menu_items">
                   <li><a href="">Доставка и оплата</a></li>
                   <li><a href="">Прайс лист</a></li>
                   <li><a href="">Контакты</a></li>
               </ul>
               <div class="language"><i class="fal fa-globe"></i>
                   &nbsp;<a href="{{ route('setlocale', ['locale' => 'ru']) }}" @if(request()->segment('1') === 'ru') class="active" @endif><span>RU</span></a>&nbsp; |
                   &nbsp;<a href="{{ route('setlocale', ['locale' => 'uk']) }}" @if(request()->segment('1') === 'uk') class="active" @endif><span>UA</span></a>
               </div>
           </div>
           <div class="logo">
               <a href="/">
                   <img src="{{$company->logo}}" alt="logo">
               </a>
           </div>
           <div class="right">
               <div class="contacts"><i class="fas fa-phone fa-rotate-90" @click="showContacts"></i>
               </div>
               <div class="basket"><i class="fal fa-shopping-cart"></i><span class="basket_price">320 грн.</span></div></div>
       </div>
   </nav>
    <div class="logo_panel">
        <div class="container nav">
            <div class="logo">
                <a href="/">
                    <img src="{{$company->logo}}" alt="logo">
                </a>
            </div>
            <div class="right">
                <div class="contacts">
                    <i class="fas fa-phone fa-rotate-90" @click="showContacts"></i>&nbsp;<span>{{$company->phones[0]}}</span>
                </div>
                <div class="language"><i class="fal fa-globe"></i>
                    <a href="{{ route('setlocale', ['locale' => 'ru']) }}" @if(request()->segment('1') === 'ru') class="active" @endif><span>RU</span></a>&nbsp; |
                    &nbsp;<a href="{{ route('setlocale', ['locale' => 'uk']) }}" @if(request()->segment('1') === 'uk') class="active" @endif><span>UA</span></a>
                </div>
            </div>
            </div>
        </div>
    <div class="layout_modal" ref="contacts" @click="hideContacts">
        <div class="modal_content contacts_list">
            <i class="fal fa-times" @click="hideContacts"></i>
            <h3>@lang('text.contacts')</h3>
            <hr>
            <ul>
                @foreach($company->phones as $phone)
                    <li><a href="tel:{{$phone}}">{{$phone}}</a></li>
                @endforeach
            </ul>
            <br>
            <h3>@lang('text.social_web')</h3>
            <hr>
            <ul class="socials">
                @foreach($company->socials as $social)
                    <li><a target="_blank" href="{{$social['url']}}"><img src="{{$social['img']}}" alt="{{$social['name']}}"></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</header>