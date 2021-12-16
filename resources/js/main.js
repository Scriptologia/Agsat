import Vue from 'vue'
import { BootstrapVue, IconsPlugin, BootstrapVueIcons } from 'bootstrap-vue'
import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );
// import VueMask from 'v-mask'
// Vue.use(VueMask);

import Multiselect from 'vue-multiselect'
import {
    ValidationObserver,
    ValidationProvider,
    extend,
    localize
} from "vee-validate";
import ru from "vee-validate/dist/locale/ru.json";
import * as rules from "vee-validate/dist/rules";

import App from './App'

import router from './router/router'
import store from './vuex/store'
import vSpinner from './components/v-spinner'
import bVSpinner from './components/b-v-spinner'
import { url_slug } from 'cyrillic-slug'
import dateFilters from './filters/date.fiters'
import floatNumber from './filters/float-number'

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
Vue.filter('date', dateFilters)
Vue.filter('floatNumber', floatNumber)
Vue.component('multiselect', Multiselect)
Vue.component("ValidationObserver", ValidationObserver);
Vue.component("ValidationProvider", ValidationProvider);
Vue.component("v-spinner", vSpinner);
Vue.component("b-v-spinner", bVSpinner);

const DEFAULT_TITLE = 'Магазин | админка';
router.afterEach((to, from) => {
    Vue.nextTick(() => {
        document.title = to.meta.title || DEFAULT_TITLE;
    });
});

Vue.directive('click-outside', {
    bind(el, binding) {
        el.addEventListener('click', e => e.stopPropagation());
        document.body.addEventListener('click', binding.value);
    },
    unbind(el, binding) {
        document.body.removeEventListener('click', binding.value);
    }
});

const main = new Vue({
    render: h => h(App),
    store, router
}).$mount('#app');
