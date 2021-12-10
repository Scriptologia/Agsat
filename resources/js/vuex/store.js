import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

let store = new Vuex.Store({
    state: {
        categories: [],
        curses: [],
        products: [],
        filters: [],
        // spinner: true
    },
    mutations : {
        SET_CURSES_TO_STATE : (state, curses) => {
            state.curses = curses;
            // state.spinner = false
        },
        SET_CATEGORIES_TO_STATE : (state, categories) => {
            state.categories = categories;
            // state.spinner = false
        },
        SET_PRODUCTS_TO_STATE : (state, products) => {
            state.products = products;
            // state.spinner = false
        },
        SET_FILTER_TO_STATE : (state, filters) => {
            state.filters = filters;
            // state.spinner = false
        }
    },
    actions : {
        GET_CATEGORIES({commit}) {
            return axios.get('/api/category' )
                .then((categories) => {
                    commit('SET_CATEGORIES_TO_STATE', categories.data.categories);
                    return categories.data.categories;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        },
        GET_CURSES({commit}) {
            return axios.get('/api/curs' )
                .then((curses) => {
                    commit('SET_CURSES_TO_STATE', curses.data.curses);
                    return curses.data.curses;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        },
        GET_PRODUCTS({commit}) {
            return axios.get('/api/product' )
                .then((products) => {
                    commit('SET_PRODUCTS_TO_STATE', products.data.products);
                    return products.data.products;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        },
        GET_FILTERS({commit}) {
            return axios.get('/api/filter' )
                .then((filters) => {
                    commit('SET_FILTER_TO_STATE', filters.data.filters);
                    return filters.data.filters;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        }
    },
    getters : {
        CURSES(state) { return state.curses ; },
        CATEGORIES(state) { return state.categories ; },
        PRODUCTS(state) { return state.products ; },
        FILTERS(state) { return state.filters ; }
    }
});

export default store;
