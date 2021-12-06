import Vue from 'vue'
import { BootstrapVue, IconsPlugin, BootstrapVueIcons } from 'bootstrap-vue'
import Multiselect from 'vue-multiselect'
import {
    ValidationObserver,
    ValidationProvider,
    extend,
    localize
} from "vee-validate";
import ru from "vee-validate/dist/locale/ru.json";
import * as rules from "vee-validate/dist/rules";
// import Router from 'vue-router'
import App from './App'

import router from './router/router'
import store from './vuex/store'
import vSpinner from './components/v-spinner'
import bVSpinner from './components/b-v-spinner'
import { url_slug } from 'cyrillic-slug'

// Импортировать файлы CSS Bootstrap и Bootstrap Vue (порядок важен)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css'

// Install VeeValidate rules and localization
Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule]);
});
localize("ru", ru);
Vue.config.productionTip = false
// Сделайте BootstrapVue доступным для всего проекта
Vue.use(BootstrapVue)
Vue.use( BootstrapVueIcons )
// При желании установите плагин компонентов иконок BootstrapVue
Vue.use(IconsPlugin)
Vue.use(url_slug)
// Vue.use(Router)
Vue.component('multiselect', Multiselect)
Vue.component("ValidationObserver", ValidationObserver);
Vue.component("ValidationProvider", ValidationProvider);
Vue.component("v-spinner", vSpinner);
Vue.component("b-v-spinner", bVSpinner);
const main = new Vue({
    render: h => h(App),
    store, router
}).$mount('#app');
