<div class="menu-block">
    <div class="container menu-items">
        <div class="menu-button" @click="showMegaMenu = !showMegaMenu">
            <i class="fal fa-chevron-down fa-lg mobile" :class="{'fa-rotate-180' : showMegaMenu}"></i>
            <p class="">
                @lang('text.product_catalog')
                <i class="fa fa-angle-down" :class="{'fa-rotate-180' : showMegaMenu}"></i>
            </p>
        </div>
        <div class="search">
            <div class="search_input">
                <div class="input">
                    <i class="fal fa-search"></i>
                    <label for="search"></label>
                    <input type="text" name="" id="search" autocomplete="off" v-model.trim="search" />
                </div>
                <button type=button>@lang('text.search')</button>
            </div>
            <div class="search_result" v-if="searchResult.length">
                <div class="item">
                    <a href="">
                        <div class="item_img">
                            <img src="{{asset('storage/category/08-01-51-03-01-2022.jpg')}}" alt="">
                        </div>
                        <div class="item_text">
                            <h4>resiver</h4>
                            <p class="price">450 грн<span class="passive">&nbsp; нет в наличии</span></p>
                            <p class="description">описание ресивера и вамыва hf hf hrft h rth    ryhrhrhrh  ryhryhrr  rhrhrthми иап па иап итап ита ти а апит а ап и</p>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <div class="item_img">
                            <img src="{{asset('storage/category/08-01-51-03-01-2022.jpg')}}" alt="">
                        </div>
                        <div class="item_text">
                            <h4>resiver</h4>
                            <p class="price">450 грн<span>&nbsp;есть</span></p>
                            <p class="description">описание ресивера и вамывами иап па иап итап ита ти а апит а ап и</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="mega-menu" v-if="showMegaMenu">
            <div class="mega-menu_first-level" v-if="categories.length">
                <ul>
                    <li v-for="(category, index) in categories" :key="index" @mouseenter.self="showSubCategories(category)" @click="showSubCategories(category)"><p>@{{category.name_ru}}</p><i class="fal fa-chevron-down fa-rotate-270 fa-xs"></i></li>
                </ul>
            </div>
            <div class="mega-menu_second-level">
                <div class="item" v-for="(category, index) in children_categories" :key="index">
                    <div class="category-header">
                        <a :href="category.slug">@{{ category.name_ru }}</a>
                    </div>
                    <div class="category-items" v-if="category.children_categories.length">
                        <a :href="subcategory.slug" v-for="(subcategory, index) in category.children_categories.filter(item => item.visible === true)" :key="index">@{{ subcategory.name_ru }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>