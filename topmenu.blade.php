<nav class="sticky fixed">
    <div class="grid">
        <div class="nav_logo">
            <i class="svg-icon">
                <img src="{{asset('icons/logo_short.svg')}}"  alt="лого" style="height:100%;">
            </i>
        </div>
        <div class="nav_menu-scroll">
        <ul class="nav_menu">
            <li class="nav_menu_item"><a class="no_decoration_pointer nav_menu_item_a @uriactive(route('action'))" href="{{route('action')}}" data-type="primary">@lang('Акції')</a></li>
        @forelse($categories as $category)
                <li class="nav_menu_item"><a class="no_decoration_pointer nav_menu_item_a" data-type="primary" href="/#{{$category['id']}}">{{$category['name']}}</a></li>
                @empty
                <li class="nav_menu_item">@lang('text.empty')</li>
            @endforelse
            @forelse($pages as $page)
                    <li class="nav_menu_item"><a class="no_decoration_pointer nav_menu_item_a @uriactive(route('page', $page->alias))" href="{{route('page', $page->alias)}}" data-type="primary">{{$page->title}}</a></li>
                @empty
                @endforelse
        </ul>
        </div>
        <div data-testid="navigation__cart" class="corzina">
                <a href="{{route('basket.index-session')}}">
                    <button type="button" data-type="primary" data-size="medium" class="button">@lang('Кошик')
                        <div class="peremichka hide"></div>
                        <div class="number hide"></div>
                    </button>
                </a>
                <div from="opacity,0,transform,translateY(5px)" to="opacity,1,transform,translateY(0)" class=""></div>
        </div>
    </div>
</nav>
