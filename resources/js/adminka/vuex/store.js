import Vue from 'vue'
import Vuex from 'vuex'
// import axios from 'axios'
// axios.defaults.withCredentials = true;

Vue.use(Vuex)

let store = new Vuex.Store({
    state: {
        categories: [],
        baskets: [],
        curses: [],
        sliders: [],
        products: [],
        services: [],
        filters: [],
        mediaFolders: [],
        mediaFiles: [],
        mediaFilesSelected: [],
        activeFolder: '',
        company: {},
        users: [],
        pages: [],
        user: null,
        roles: [],
        permissions: [],
        resizes: []
    },
    mutations : {
        SET_SERVICES_TO_STATE : (state, services = null) => {
            state.services = services;
        },
        SET_PAGES_TO_STATE : (state, pages = null) => {
            state.pages = pages;
        },
        SET_BASKETS_TO_STATE : (state, baskets = null) => {
            state.baskets = baskets;
        },
        SET_MEDIA_USER_TO_STATE : (state, user = null) => {
            state.user = user;
        },
        SET_MEDIA_USERS_TO_STATE : (state, users = []) => {
            state.users = users;
        },
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
        },
        SET_ROLES_TO_STATE : (state, roles) => {
            state.roles = roles;
        },
        SET_PERMISSIONS_TO_STATE : (state, permissions) => {
            state.permissions = permissions;
        }
    },
    actions : {
        GET_SERVICES({commit}) {
            return axios.get('/api/service' )
                .then((services) => {
                    commit('SET_SERVICES_TO_STATE', services.data.services);
                    return services.data.services;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        },
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
        GET_BASKETS({commit}) {
            return axios.get('/api/baskets' )
                .then((baskets) => {
                    commit('SET_BASKETS_TO_STATE', baskets.data.baskets);
                    return baskets.data.baskets;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        },
        GET_PAGES({commit}) {
            return axios.get('/api/pages' )
                .then((pages) => {
                    commit('SET_PAGES_TO_STATE', pages.data.pages);
                    return pages.data.pages;
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
        GET_USERS({commit}) {
            return axios.get('/api/user' )
                .then((users) => {
                    commit('SET_MEDIA_USERS_TO_STATE', users.data.users);
                    return users.data.users;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        },
        GET_USER({commit}) {
            return axios.get('/api/user/autor' )
                .then((user) => {
                    commit('SET_MEDIA_USER_TO_STATE', user.data.user);
                    return user.data.user;
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
        },
        GET_PERMISSIONS({commit}) {
            return axios.get('/api/permission' )
                .then((permissions) => {
                    commit('SET_PERMISSIONS_TO_STATE', permissions.data.permissions);
                    return permissions.data.permissions;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        },
        GET_ROLES({commit}) {
            return axios.get('/api/role' )
                .then((roles) => {
                    commit('SET_ROLES_TO_STATE', roles.data.roles);
                    return roles.data.roles;
                })
                .catch((error) => {
                    console.log(error);
                    return error;
                })
        }
    },
    getters : {
        SERVICES(state) { return state.services ; },
        PAGES(state) { return state.page ; },
        BASKETS(state) { return state.baskets ; },
        CURSES(state) { return state.curses ; },
        RESIZES(state) { return state.resizes ; },
        USERS(state) { return state.users ; },
        CATEGORIES(state) { return state.categories ; },
        PRODUCTS(state) { return state.products ; },
        FILTERS(state) { return state.filters ; },
        MEDIA_FOLDERS(state) { return state.mediaFolders ; },
        COMPANY(state) { return state.company ; }
    }
});

export default store;
