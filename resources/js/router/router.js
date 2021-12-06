import Vue from 'vue'
import Router from 'vue-router'
import vLayout from '../pages/v-layout'
import vHome from '../pages/v-home'
import vCategories from '../pages/v-categories'
import vProducts from '../pages/v-products'
import vCurs from '../pages/v-curs'
import vFilters from '../pages/v-filters'
import v404 from '../pages/v-404'

Vue.use(Router);

let router = new Router({
    mode: 'history',
    routes: [
        // {
        //     path: '/adminka/',
        //     name: 'home',
        //     component: vHome
        // },
        // {
        //     path: '/adminka/categories',
        //     name: 'categories',
        //     component: vCategory,
        //     props: true
        // },
        // {
        //     path: '/adminka/products',
        //     name: 'products',
        //     component: vProduct,
        //     props: true
        // },
        // {
        //     path: '*',
        //     name: '404',
        //     component: v404,
        //     props: true
        // },
        {
            path: '',
            component: vLayout,
            children: [
                {
                    path: '',
                    name: 'home',
                    component: vHome
                },
                {
                    path: 'filters',
                    name: 'filters',
                    component: vFilters,
                    props: true
                },
                {
                    path: 'curs',
                    name: 'curs',
                    component: vCurs,
                    props: true
                },
                {
                    path: 'categories',
                    name: 'categories',
                    component: vCategories,
                    props: true
                },
                {
                    path: 'products',
                    name: 'products',
                    component: vProducts,
                    props: true
                },
                {
                    path: '*',
                    name: '404',
                    component: v404,
                    props: true
                }
            ]
        }
    ]
});
export default router;