<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <div  v-b-toggle.sidebar-border><b-icon-box-arrow-in-right font-scale="2" variant="white" class="mr-3"></b-icon-box-arrow-in-right></div>

            <b-navbar-brand href="/">{{$store.state.company.name}}</b-navbar-brand>
            <!--<b-button v-b-toggle.sidebar-no-header>Toggle Sidebar</b-button>-->

            <!--<b-button target="nav-collapse"></b-button>-->

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <!--<b-navbar-nav>-->
                    <!--<b-nav-item href="#">Link</b-nav-item>-->
                    <!--<b-nav-item href="#" disabled>Disabled</b-nav-item>-->
                <!--</b-navbar-nav>-->

                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <!--<b-nav-form>-->
                        <!--<b-form-input size="sm" class="mr-sm-2" placeholder="Search"></b-form-input>-->
                        <!--<b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>-->
                    <!--</b-nav-form>-->

                    <!--<b-nav-item-dropdown text="Lang" right>-->
                        <!--<b-dropdown-item href="#">EN</b-dropdown-item>-->
                        <!--<b-dropdown-item href="#">ES</b-dropdown-item>-->
                        <!--<b-dropdown-item href="#">RU</b-dropdown-item>-->
                        <!--<b-dropdown-item href="#">FA</b-dropdown-item>-->
                    <!--</b-nav-item-dropdown>-->

                    <b-nav-item-dropdown right  v-if="$store.state.user">
                        <!-- Using 'button-content' slot -->
                        <template #button-content>
                            <em>{{$store.state.user.name}}</em>
                        </template>
                        <b-dropdown-item href="#">{{$store.state.user.role.name}}</b-dropdown-item>
                        <b-dropdown-item href="#"
                            @click.prevent="logout">
                                <b-icon-box-arrow-right class="mr-3 my=3"></b-icon-box-arrow-right>Выход
                        </b-dropdown-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
    export default {
        name: "v-navbar",
        components: {},
        methods: {
            logout (){
                axios.post('/logout')
                    .then(res => {
                        localStorage.removeItem('x_xsrf_token')
                        this.$router.push({name: 'login'})
                    })
            }
        }
    }
</script>

<style scoped>

</style>