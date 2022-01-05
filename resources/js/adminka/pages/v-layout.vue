<template>
<div>
    <v-sidebar v-if="token"></v-sidebar>
    <v-navbar></v-navbar>
    <!--<v-breadcrumb></v-breadcrumb>-->
    <b-container>
       <router-view></router-view>
    </b-container>
</div>
</template>

<script>
    import vNavbar from '../components/v-navbar'
    import vSidebar from '../components/v-sidebar'
    // import vBreadcrumb from '../components/v-breadcrumb'

    export default {
        name: "v-layout",
        components: {vNavbar, vSidebar},
        data(){
            return {
                token: null
            }
        },
        methods: {
            getToken (){
                this.token = localStorage.getItem('x_xsrf_token')
            }
        },
        mounted(){
            this.getToken()
        },
        updated(){
            this.getToken()
        }
    }
</script>

<style>

</style>