<template>
    <transition name="slide">
        <div>
            <h1>Товары</h1>
            <b-col lg="12" class="my-1 d-flex justify-content-between align-items-end">
                <b-button  variant="success" @click="info({}, 0, $event.target)"><b-icon-plus></b-icon-plus>Добавить</b-button>
                <b-form-group
                        label="Filter"
                        label-for="filter-input"
                        label-cols-sm="3"
                        label-align-sm="right"
                        label-size="sm"
                        class="mb-0 col-6"
                >
                    <b-input-group size="sm">
                        <b-form-input
                                id="filter-input"
                                v-model="filter"
                                type="search"
                                placeholder="поиск в таблице..."
                        ></b-form-input>

                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''">Искать</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-table :busy="spinner"
                    id="table"
                    :items=this.$store.state.products
                    :per-page="perPage"
                    :current-page="currentPage"
                    :fields="fields"
                    :sort-by.sync="sortBy"
                    :sort-desc.sync="sortDesc"
                    responsive="sm"
                    small
                    striped hover
                    @filtered="onFiltered"
                    :filter="filter"
                    :filter-included-fields="filterOn"
                     show-empty
            ><template #table-busy>
                <div class="text-center text-danger my-2">
                    <b-spinner class="align-middle"></b-spinner>
                </div>
            </template>
                <template #empty="scope">
                    <h4>{{ empty.emptyText }}</h4>
                </template>
                <template #emptyfiltered="scope">
                    <h4>{{ empty.emptyFilteredText }}</h4>
                </template>
                <template #cell(edit)="row">
                    <b-icon-pencil @click="info(row.item, row.index, $event.target)" variant="primary" type="button"></b-icon-pencil>
                </template>
                <template #cell(delete)="row">
                    <b-icon-trash variant="danger" @click="deleteCategory(row.item)" type="button"></b-icon-trash>
                </template>
            </b-table>
            <b-pagination v-if="rows >= perPage"
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="table"
                    limit="3"
                    align="right"
            ></b-pagination>
            <!-- Info modal -->
            <b-modal :id="infoModal.id" :title="infoModal.title" hide-footer @hide="resetInfoModal" size="lg" no-enforce-focus>
                <v-product-edit :product="infoModal.content" :categories="infoModal.freeChildren" :filterOptions="this.$store.state.filters" :curses="this.$store.state.curses"></v-product-edit>
            </b-modal>
        </div>
    </transition>
</template>

<script>
    // import vTable from '../components/v-table'
    // import axios from 'axios'
    import vProductEdit from '../components/v-product-edit'
    import {mapActions} from 'vuex'
    export default {
        name: "v-products",
        components: {vProductEdit},
        data() {
            return {
                spinner: true,
                categories:[],
                empty : {emptyText: 'ничего не найдено', emptyFilteredText: 'по этому запросу ничего не найдено'},
                perPage: 20,
                currentPage: 1,
                sortBy: 'id',
                sortDesc: false,
                fields: [
                    { key: 'id', sortable: true },
                    { key: 'name_ru', sortable: true, label:'Название',
                        formatter: (value, key, item) => {
                            return item.lines? item.lines +  value : value;
                        },
                    },
                    { key: 'category_id', sortable: true , label:'Категория',
                        formatter: (value, key, item) => {
                            let its = this.categories.find(it => it.id  === item.category_id)
                            return its? its.name_ru : 'корень';
                        },
                        sortByFormatted: true,
                        filterByFormatted: true
                    },
                    { key: 'slug', sortable: true, label:'Slug' },
                    { key: 'price', sortable: true, label:'Цена',
                        formatter: (value, key, item) => {
                            let its = this.$store.state.curses.find(it => it.id  === item.curs_id)
                            return its? value + ' ' + its.name : value;
                        },
                        sortByFormatted: true,
                        filterByFormatted: true
                    },
                    { key: 'skidka', sortable: true, label:'Скидка' },
                    { key: 'img', sortable: false, label:'Изображение',
                        formatter: (value, key, item) => {
                            let its = value !== null && value.length? value.find(it => it.main === true) : false
                            return its? 'есть главная' : 'нет главной';
                        },
                        sortByFormatted: true,
                        filterByFormatted: true
                        },
                    { key: 'visible', sortable: true, label:'Отображать',
                    formatter: (value, key, item) => {
                        return item.visible? 'видимая' : 'скрытая';
                    },
                        sortByFormatted: true,
                        filterByFormatted: true
                    },
                    { key: 'created_at', sortable: true, label:'Создан',
                        formatter: (value, key, item) => {
                            return this.$options.filters.date(item.created_at, 'date time');
                        },
                        sortByFormatted: true,
                        filterByFormatted: true
                    },
                    { key: 'edit',  label:'Ред.' },
                    { key: 'delete',  label:'Уд.' },
                ],
                filter: null,
                filterOn: [],
                infoModal: {
                    id: 'product-edit',
                    title: '',
                    content: ''
                }
            }
        },
        methods: {
            ...mapActions([
                'GET_CATEGORIES', 'GET_PRODUCTS', 'GET_CURSES'
            ]),
            makeToast(append = false, message, status) {
            this.$bvToast.toast(`${message}`, {
                title: status? 'Успешно' : 'Ошибка',
                autoHideDelay: 5000,
                appendToast: append,
                variant: status? 'success' : 'danger'
            })
        },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            info(item, index, button) {
                if(item.slug)  {this.infoModal.title = `Редактирование товара: ${item.name_ru}`;}
                else {this.infoModal.title = 'Создание товара'}
                this.infoModal.content =  item
                this.infoModal.freeChildren = this.treeCategories(this.$store.state.categories, item)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = {}
            },
            deleteCategory(item) {
                this.$bvModal.msgBoxConfirm('Вы действительно хотите удалить?', {
                    title: 'Внимание !',
                    buttonSize: 'xlg',
                    okVariant: 'danger',
                    okTitle: 'Да',
                    cancelTitle: 'Нет',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true,
                    bodyBgVariant:'warning'
                })
                    .then(value => {
                        if(value) {
                            axios.delete('/api/product/' + item.slug )
                                .then((res) => {
                                    this.makeToast(true, res.data.message, res.data.status);
                                    if(res.data.status)  {
                                        setTimeout(() => {this.GET_PRODUCTS()}, 1000);
                                    }
                                })
                                .catch((error) => {
                                    console.log(error);
                                    return error;
                                });
                        }
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            treeCategories(arr, item) {
                let newArr = []
                arr.forEach(function (it) {
                    it.lines = ''
                    if(it.id !== item.id) {
                        it.name = it.lines + it.name_ru
                        newArr.push(it)
                        function toChildren(children, lines) {
                            children.forEach(function (it) {
                                it.lines = ''
                                it.lines = '-'+lines
                                if(it.id !== item.id) {
                                    it.name = it.lines + it.name_ru
                                    newArr.push(it)
                                    if(it.children_categories) {
                                        if(it.id !== item.id) toChildren(it.children_categories, it.lines);
                                    }
                                }
                            })
                        }
                        if(it.children_categories) {
                            if(it.id !== item.id) toChildren(it.children_categories, it.lines, it);
                        }
                    }
                })
                return newArr;
            },
            categoriesToArray (arr){
                let newArr = []
                arr.forEach(function (it) {
                        newArr.push(it)
                        function toChildren(children) {
                            children.forEach(function (it) {
                                    newArr.push(it)
                                    if(it.children_categories) {
                                        toChildren(it.children_categories);
                                    }
                            })
                        }
                        if(it.children_categories) {
                            toChildren(it.children_categories);
                        }
                })
                return newArr;
            }
        },
        mounted(){
            this.spinner = true
            let obj = this
            this.GET_PRODUCTS().then(() => {
                this.spinner = false
            });
            this.GET_CATEGORIES().then((item) => {
                obj.categories = obj.categoriesToArray(item)
            }).catch((err) => {console.log('Ошибка получения категории!', err)})
            this.GET_CURSES()
        },
        computed: {
            rows() {
                return this.$store.state.products.length
            }
        }
    }
</script>

<style>
 .prev {width: 30px;height:auto;}
</style>