<div class="menu-block">
    <div class="container menu-items"  v-cloak>
        <div class="menu-button" @click="showMegaMenu = !showMegaMenu">
            <i class="fal fa-chevron-down fa-lg mobile" :class="{'fa-rotate-180' : showMegaMenu}"></i>
            <p>
                @lang('text.product_catalog')
                <i class="fa fa-angle-down" :class="{'fa-rotate-180' : showMegaMenu}"></i>
            </p>
        </div>
        <div class="search">
            <div class="search_input">
                <div class="input">
                    <i class="fal fa-times"  v-if="search" @click="searchResult = {}; search = ''"></i>
                    <i class="fal fa-search" v-else></i>
                    <label for="search"></label>
                    <input type="text" name="" id="search" autocomplete="off" v-model.trim="search" />
                </div>
                <button type=button>@lang('text.search')</button>
            </div>
            <div class="search_result"  v-cloak v-if="search">
                <template v-if="searchResult.products && searchResult.products.length">
                    <div class="item" v-for="(product, index) in searchResult.products" :key="index">
                        <div class="item_img" v-if="product.img && product.img.find(it => it.main == true)">
                            <a :href="'/'+lang+'/'+product.categories[0].slug+'/'+product.slug" >
                                <img :src="product.img.find(it => it.main == true).img"  loading="lazy">
                            </a>
                        </div>
                        <div class="item_text">
                            <a :href="'/'+lang+'/'+product.categories[0].slug+'/'+product.slug">
                                <h4>@{{product['name_'+lang]}}</h4>
                            </a>
                            <p class="price">@{{parseFloat((product.price * product.curs.curs).toFixed(2))}} грн.
                                <span class="active" v-if="product.count">&nbsp; @lang('text.yes-product')</span>
                                <span class="passive" v-else>&nbsp;  @lang('text.no-product')</span>
                            </p>
                            <div class="description" v-html="product['description_'+lang]"></div>
                        </div>
                    </div>
                </template>
                <p v-else>@lang('text.no-result')</p>
            </div>
        </div>
        <div class="mega-menu" v-if="showMegaMenu" v-cloak>
            <div class="mega-menu_first-level" v-if="categories.length">
                <ul>
                    <li v-for="(category, index) in categories" :key="index" @mouseenter.self="showSubCategories(category)" @click="showSubCategories(category)"><p>@{{category['name_'+lang]}}</p><i class="fal fa-chevron-down fa-rotate-270 fa-xs"></i></li>
                </ul>
            </div>
            <div class="mega-menu_second-level">
                <div class="item" v-for="(category, index) in children_categories" :key="index">
                    <div class="category-header">
                        <a :href="lang+'/'+category.slug">@{{ category['name_'+lang] }}</a>
                    </div>
                    <div class="category-items" v-if="category.children_categories.length">
                        <a :href="lang+'/'+subcategory.slug" v-for="(subcategory, index) in category.children_categories.filter(item => item.visible == true)" :key="index">@{{ subcategory['name_'+lang] }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>