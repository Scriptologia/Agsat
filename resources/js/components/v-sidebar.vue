<template>
    <div>
        <b-sidebar id="sidebar-border" aria-labelledby="sidebar-no-header-title"  shadow sidebar-class="border-right">
            <template #default="{ hide }">
                <div class="p-3">
                    <nav class="mb-3">
                        <b-nav vertical >
                            <b-nav-item :to="{name: 'home'}" @click="hide" exact-active-class="active"><b-icon-house class="mr-3"></b-icon-house>Главная</b-nav-item>
                            <!--<p class="h5 mb-2 d-flex justify-content-between"  v-b-toggle.collapse-1 >Icon <b-icon-chevron-down></b-icon-chevron-down></p>-->
                            <!--<b-collapse id="collapse-1" class="mt-2">-->
                                <b-nav-item :to="{name: 'company'}" @click="hide" exact-active-class="active"><b-icon-house-door class="mr-3"></b-icon-house-door>О компания</b-nav-item>
                                <b-nav-item :to="{name: 'products'}" @click="hide" exact-active-class="active"><b-icon-cart3 class="mr-3"></b-icon-cart3>Товары</b-nav-item>
                                <b-nav-item  :to="{name: 'categories'}" @click="hide" exact-active-class="active"><b-icon-diagram3 class="mr-3"></b-icon-diagram3>Категории</b-nav-item>
                                <b-nav-item  :to="{name: 'filters'}" @click="hide" exact-active-class="active"><b-icon-funnel class="mr-3"></b-icon-funnel>Фильтры</b-nav-item>
                                <b-nav-item  :to="{name: 'sliders'}" @click="hide" exact-active-class="active"><b-icon-film rotate="90" class="mr-3"></b-icon-film>Слайдер</b-nav-item>
                                <b-nav-item  :to="{name: 'curs'}" @click="hide" exact-active-class="active"><b-icon-cash class="mr-3"></b-icon-cash>Валюты</b-nav-item>
                                <b-nav-item  :to="{name: 'resizes'}" @click="hide" exact-active-class="active"><b-icon-aspect-ratio class="mr-3"></b-icon-aspect-ratio>Размеры изображений</b-nav-item>
                            <!--</b-collapse>-->
                        </b-nav>
                    </nav>
                    <b-button variant="primary" block @click="hide">Close Sidebar</b-button>
                </div>
            </template>
        </b-sidebar>
    </div>
</template>

<script>
    export default {
        name: "v-sidebar",
    }
</script>

<style>
    .nav-item > .active {background: aliceblue;}
    .nav-item > a:hover {background: antiquewhite;}
</style>