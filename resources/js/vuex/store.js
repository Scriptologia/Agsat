import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

let store = new Vuex.Store({
    state: {
        categories: [],
        curses: [],
        sliders: [],
        products: [],
        filters: [],
        mediaFolders: [],
        mediaFiles: [],
        mediaFilesSelected: [],
        activeFolder: '',
        company: {},
        resizes: []
    },
    mutations : {
        SET_MEDIA_SELECTED_FILES_TO_STATE : (state, mediaFilesSelected = []) => {
            state.mediaFilesSelected = mediaFilesSelected;
        },
        SET_MEDIA_ACTIVE_FOLDER_TO_STATE : (state, activeFolder) => {
            state.activeFolder = activeFolder;
        },
        SET_MEDIA_FOLDERS_TO_STATE : (state, mediaFolders) => {
            state.mediaFolders = mediaFolders;
        },
        SET_MEDIA_FILES_TO_STATE : (state, mediaFiles) => {
            state.mediaFiles = mediaFiles;
        },
        SET_SLIDERS_TO_STATE : (state, sliders) => {
            state.sliders = sliders;
        },
        SET_CURSES_TO_STATE : (state, curses) => {
            state.curses = curses;
        },
        SET_RESIZES_TO_STATE : (state, resizes) => {
            state.resizes = resizes;
        },
        SET_CATEGORIES_TO_STATE : (state, categories) => {
            state.categories = categories;
        },
        SET_PRODUCTS_TO_STATE : (state, products) => {
            state.products = products;
        },
        SET_FILTER_TO_STATE : (state, filters) => {
            state.filters = filters;
        },
        SET_COMPANY_TO_STATE : (state, company) => {
            state.company = company;
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
        GET_MEDIA_FOLDERS({commit, state}, folder) {
            let url = folder? '/api/media?directory=' + folder : '/api/media'
            return axios.get(url)
                .then((res) => {
                    let data;
                    if(folder) {
                        let find = true;
                        function makeMap (arr){
                            return arr.children.map(function (item) {
                                if (item.fullUrl === folder) { item.children = res.data.message.folders ;find = false; return item;}
                                if(item.children){
                                    makeMap(item)
                                }
                                return item;
                            })
                        }
                        if(state.mediaFolders.length){
                            data =  state.mediaFolders.map(function (item) {
                                if(find){
                                    if (item.fullUrl === folder) {
                                        item.children = res.data.message.folders ;find = false; return item;
                                    }
                                    if (item.children) {
                                        makeMap(item)
                                    }
                                }
                                return  item;
                            })
                        }
                        else {
                            data = res.data.message.folders;
                        }
                    }
                    else { data = res.data.message.folders}

                    commit('SET_MEDIA_ACTIVE_FOLDER_TO_STATE', folder);
                    commit('SET_MEDIA_FOLDERS_TO_STATE', data);
                    commit('SET_MEDIA_FILES_TO_STATE', res.data.message.files);
                })
                .catch((error) => {
                    console.log('Ошибка получения папок или файлов',error);
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
        GET_SLIDERS({commit}) {
            return axios.get('/api/sliders' )
                .then((sliders) => {
                    commit('SET_SLIDERS_TO_STATE', sliders.data.sliders);
                    return sliders.data.sliders;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        },
        GET_COMPANY({commit}) {
            return axios.get('/api/company' )
                .then((company) => {
                    commit('SET_COMPANY_TO_STATE', company.data.company);
                    return company.data.company;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        },
        GET_RESIZES({commit}) {
            return axios.get('/api/resizes' )
                .then((resizes) => {
                    commit('SET_RESIZES_TO_STATE', resizes.data.resizes);
                    return resizes.data.resizes;
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
        RESIZES(state) { return state.resizes ; },
        CATEGORIES(state) { return state.categories ; },
        PRODUCTS(state) { return state.products ; },
        FILTERS(state) { return state.filters ; },
        MEDIA_FOLDERS(state) { return state.mediaFolders ; },
        COMPANY(state) { return state.company ; }
    }
});

export default store;
