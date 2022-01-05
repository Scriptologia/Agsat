<template>
    <div id="app">
        <!--<v-sidebar></v-sidebar>-->
        <!--<v-navbar></v-navbar>-->
        <!--<v-breadcrumb></v-breadcrumb>-->
        <transition>
            <!--<b-container>-->
                <router-view></router-view>
            <!--</b-container>-->
        </transition>
    </div>
</template>

<script>
    import vNavbar from './components/v-navbar'
    import vSidebar from './components/v-sidebar'
    import vBreadcrumb from './components/v-breadcrumb'

    export default {
        name: "App",
        // components: {vNavbar, vSidebar, vBreadcrumb},
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss">

</style>