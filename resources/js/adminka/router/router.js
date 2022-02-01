import Vue from 'vue'
import Router from 'vue-router'
import vLayout from '../pages/v-layout'
import vHome from '../pages/v-home'
import vCategories from '../pages/v-categories'
import vProducts from '../pages/v-products'
import vServices from '../pages/v-services'
import vPages from '../pages/v-pages'
import vCurs from '../pages/v-curs'
import vFilters from '../pages/v-filters'
import vResizes from '../pages/v-resizes'
import vSliders from '../pages/v-sliders'
import vCompany from '../pages/v-company'
import vLogin from '../pages/v-login'
import vRole from '../pages/v-roles'
import vPermission from '../pages/v-permissions'
import vBasket from '../pages/v-baskets'
import vUsers from '../pages/v-users'
import v404 from '../pages/v-404'
import store from '../vuex/store'

Vue.use(Router);

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: 'login',
            name: 'login',
            component: vLogin,
            props: true,
            meta: { title: 'Войти | админка' }
        },
        {
            path: '',
            component: vLayout,
            children: [
                {
                    path: '',
                    name: 'home',
                    component: vHome,
                    meta: { title: 'Главная | админка' }
                },
                {
                    path: 'filters',
                    name: 'filters',
                    component: vFilters,
                    props: true,
                    meta: { title: 'Фильтры | админка' }
                },
                {
                    path: 'curs',
                    name: 'curs',
                    component: vCurs,
                    props: true,
                    meta: { title: 'Валюта | админка' }
                },
                {
                    path: 'company',
                    name: 'company',
                    component: vCompany,
                    props: true,
                    meta: { title: 'О компании | админка' }
                },
                {
                    path: 'sliders',
                    name: 'sliders',
                    component: vSliders,
                    props: true,
                    meta: { title: 'Слайдер | админка' }
                },
                {
                    path: 'categories',
                    name: 'categories',
                    component: vCategories,
                    props: true,
                    meta: { title: 'Категория | админка' }
                },
                {
                    path: 'baskets',
                    name: 'baskets',
                    component: vBasket,
                    props: true,
                    meta: { title: 'Заказы | админка' }
                },
                {
                    path: 'products',
                    name: 'products',
                    component: vProducts,
                    props: true,
                    meta: { title: 'Товары | админка' }
                },
                {
                    path: 'services',
                    name: 'services',
                    component: vServices,
                    props: true,
                    meta: { title: 'Доп.услуги | админка' }
                },
                {
                    path: 'pages',
                    name: 'pages',
                    component: vPages,
                    props: true,
                    meta: { title: 'Страницы | админка' }
                },
                {
                    path: 'resizes',
                    name: 'resizes',
                    component: vResizes,
                    props: true,
                    meta: { title: 'Размеры | админка' }
                },

                {
                    path: 'users',
                    name: 'users',
                    component: vUsers,
                    props: true,
                    meta: { title: 'Пользователи | админка' }
                },
                {
                    path: 'roles',
                    name: 'roles',
                    component: vRole,
                    props: true,
                    meta: { title: 'Роли | админка' }
                },
                {
                    path: 'permissions',
                    name: 'permissions',
                    component: vPermission,
                    props: true,
                    meta: { title: 'Права | админка' }
                },
                {
                    path: '*',
                    name: '404',
                    component: v404,
                    props: true,
                    meta: { title: '404 | админка' }
                }
            ]
        }
    ]
})
 router.beforeEach((to, from, next) => {
     const  token = localStorage.getItem('x_xsrf_token')
     if(!token) {
         if(to.name === 'login' ||  to.name === 'register') {
             return next();
         } else {
             return next({name: 'login'})
         }
     }

     store.dispatch('GET_USER')
     store.dispatch('GET_COMPANY')
     if((to.name === 'login' || to.name === 'register') && token) {
         return next({name: 'home'})
     }
     return next();
 });
export default router;