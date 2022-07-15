<header class="">
    @if($company->time->start !== $company->time->end)
    <div class="header_banner">
        <div class="header_banner_item" style="color:green">
            <i class="fal fa-clock"></i> {{$company->time->start}} -{{$company->time->end}} &nbsp;&nbsp;
            @if($company->time->from !== $company->time->to)
            <i class="fal fa-utensils"></i> {{$company->time->from}} -{{$company->time->to}}
                @endif
        </div>
    </div>
    @endif
   <nav>
       <div class="container nav">
       <i class="fal fa-bars fa-lg nav_burger" @click="toggleNavMenu"></i>
           <div class="nav_menu" ref="nav_menu">
               <i class="fal fa-times" @click="toggleNavMenu"></i>
               <ul class="nav_menu_items">
                   @foreach($pages as $page)
                   <li><a href="{{route('page',$page)}}">{{$page->{'name_'.App::getLocale() } }}</a></li>
                   @endforeach
                    <li><a href="{{route('contacts')}}">@lang('text.contacts')</a></li>
                    <li><a href="{{route('chat')}}">@lang('text.chat')</a></li>
               </ul>
               <div class="language"><i class="fal fa-globe"></i>
                   &nbsp;<a href="{{ route('setlocale', ['locale' => 'ru']) }}" @if(request()->segment('1') === 'ru') class="active" @endif><span>RU</span></a>&nbsp; |
                   &nbsp;<a href="{{ route('setlocale', ['locale' => 'uk']) }}" @if(request()->segment('1') === 'uk') class="active" @endif><span>UA</span></a>
               </div>
           </div>
           <div class="logo">
               <a href="{{route('home')}}">
                   <img src="{{$company->logo}}" alt="logo">
               </a>
           </div>
           <div class="right">
               <div class="contacts">
                   <i class="fas fa-phone fa-rotate-90" @click="showModal('contacts')"></i>
               </div>
               <div class="basket"  v-cloak>
                   <a href="{{route('basket')}}">
                       <i class="fal fa-shopping-cart"></i>
                       <span class="basket_price" v-if="basket.totalPrice">@{{ basket.totalPrice }} грн.</span>
                       <span class="basket_number" v-if="basket.totalNumber">@{{ basket.totalNumber }}</span>
                   </a>
               </div>
           </div>
       </div>
   </nav>
    <div class="logo_panel">
        <div class="container nav">
            <div class="logo">
                <a href="{{route('home')}}">
                    <img src="{{$company->logo}}" alt="logo">
                </a>
            </div>
            <div class="right">
                <div class="contacts" @click="showModal('contacts')"  v-cloak>
                    <i class="fas fa-phone fa-rotate-90"></i>&nbsp;<span>{{$company->phones[0]}} </span>
                    <i class="fa fa-angle-down" style="background: none;"></i>
                </div>
                <div class="language"><i class="fal fa-globe"></i>
                    <a href="{{ route('setlocale', ['locale' => 'ru']) }}" @if(request()->segment('1') === 'ru') class="active" @endif><span>RU</span></a>&nbsp; |
                    &nbsp;<a href="{{ route('setlocale', ['locale' => 'uk']) }}" @if(request()->segment('1') === 'uk') class="active" @endif><span>UA</span></a>
                </div>
            </div>
            </div>
        </div>
    <div class="layout_modal" ref="contacts" @click="hideModal('contacts')">
        <div class="modal_content contacts_list">
            <i class="fal fa-times" @click="hideModal('contacts')"></i>
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