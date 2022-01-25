<template>
    <transition name="slide">
        <div class="v-basket">
            <v-spinner v-if="spinner"></v-spinner>
                    <b-card bg-variant="light">
                        <b-form @submit.stop.prevent="onSubmit">
                            <b-card-text>
                                <b-form-group label="Закрыть заказ:">
                                    <b-form-checkbox
                                            id="is_closed"
                                            v-model="is_closed"
                                            name="is_closed-1"
                                    >
                                        <span v-if="is_closed" class="text-success">Закрыт</span>
                                        <span v-if="!is_closed" class="text-primary">Открыт</span>
                                    </b-form-checkbox>
                                </b-form-group>
                                <h5>Персональные данные:</h5>
                                <ul class="person">
                                    <li>Имя : <b>{{person.name}}</b></li>
                                    <li>Фамилия : <b>{{person.surname}}</b></li>
                                    <li>Отчество : <b>{{person.patronymico}}</b></li>
                                    <li>Телефон : <b>{{person.phone}}</b></li>
                                    <li>Область : <b>{{person.region}}</b></li>
                                    <li>Город : <b>{{person.city}}</b></li>
                                    <li>Отделение Новой почты : <b>{{person.post}}</b></li>
                                </ul>
                                <h5>Товары:</h5>
                                <b-table :busy="spinner"
                                         id="table"
                                         :items="products"
                                         :per-page="perPage"
                                         :current-page="currentPage"
                                         :fields="fields"
                                         :sort-by.sync="sortBy"
                                         :sort-desc.sync="sortDesc"
                                         responsive="xl"
                                         small
                                         striped hover
                                         @filtered="onFiltered"
                                         :filter="filter"
                                         :filter-included-fields="filterOn"
                                         show-empty
                                >
                                    <template #table-busy>
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
                                    <template #cell(img)="row">
                                        <img :src="row.item.img" class="slide">
                                    </template>
                                    <template #cell(name)="row">
                                        <a :href="'http://agsat/'+row.item.category_slug+'/'+row.item.slug"
                                           target="_blank">{{row.item.name}}</a>
                                    </template>
                                    <template #cell(in_basket)="row">
                                        <b-form-input id="number" type="number"
                                                      v-model.number="row.item.in_basket"
                                                      min="1"
                                                      :max="row.item.count"
                                        ></b-form-input>
                                    </template>
                                    <template #cell(delete)="row">
                                        <b-icon-trash variant="danger" @click="deleteProduct(row)"
                                                      type="button"  v-if="!basket.is_closed"></b-icon-trash>
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
                            </b-card-text>
                            <div class="d-flex justify-content-between">
                                <div class="price"><h4 class="text-success">Итого: {{price}} грн.</h4></div>
                                <b-button class="ml-2" type="submit" variant="success" v-if="!basket.is_closed">Сохранить</b-button>
                            </div>
                        </b-form>
                    </b-card>
        </div>
    </transition>
</template>

<script>
    import {mapMutations, mapActions} from 'vuex'

    export default {
        name: "v-basket-edit",
        props: {
            basket: Object,
        },
        data() {
            return {
                spinner: false,
                empty : {emptyText: 'ничего не найдено', emptyFilteredText: 'по этому запросу ничего не найдено'},
                perPage: 10,
                products:[],
                person:this.basket.person || {},
                price: this.basket.price || 0,
                is_closed: this.basket.is_closed || false,
                currentPage: 1,
                sortBy: 'id',
                sortDesc: false,
                fields: [
                    { key: 'id', sortable: true, label:'Артикул' },
                    { key: 'img', sortable: false, label:'Изображение' ,
                        sortByFormatted: false,
                        filterByFormatted: false },
                    { key: 'name', sortable: true, label:'Ссылка' },
                    { key: 'count', sortable: true, label:'На складе, шт.'},
                    { key: 'in_basket', sortable: true, label:'Количество'},
                    { key: 'price_curs', sortable: true, label:'Цена, грн.'},
                    { key: 'price_all', sortable: true, label:'Всего, грн.'},
                    { key: 'skidka', sortable: true, label:'Скидка, %.'},
                    { key: 'curs_name', sortable: true, label:'Валюта'},
                    { key: 'curs', sortable: true, label:'Курс'},
                    { key: 'delete',  label:'Уд.' },
                ],
                filter: null,
                filterOn: [],
                infoModal: {
                    id: 'basket-edit',
                    title: '',
                    content: ''
                }
            }
        },
        methods: {
            ...mapActions([
                'GET_BASKETS'
            ]),
            deleteProduct(row){
                this.products.splice(row.index, 1)
            },
            toastMessage(message){
                let str = '';
                if(typeof message === 'object'){
                    for (const [p, val] of Object.entries(message)) {
                        str += `${p}:${val.join(' \n ')}\n`;
                    }
                } else {str = message;}
                return str;
            },
            makeToast(append = false, message, status) {
                this.$bvToast.toast(`${message}`, {
                    title: status ? 'Успешно' : 'Ошибка',
                    autoHideDelay: 5000,
                    appendToast: append,
                    variant: status ? 'success' : 'danger'
                })
            },
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            info(item, index, button) {
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = {}
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            onSubmit() {
                let data = {
                    products:this.products,
                    person:this.person,
                    is_closed:this.is_closed,
                    price:this.price,
                }
                axios({
                    url: '/api/baskets/' + this.basket.id,
                    data,
                    method: this.basket.id ? 'put' : 'post',
                    })
                    .then((res) => {
                        this.makeToast(true,  this.toastMessage(res.data.message), res.data.status);
                        if (res.data.status) {
                            this.GET_BASKETS();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'basket-edit')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея категории : ', error);
                    });
            },
        },
        computed: {
            rows() {
                return this.products.length
            }
        },
        watch: {
            products: {
                handler(newProducts, oldProducts) {
                    let prod = newProducts.map(function (item) {
                        // item.count < item.in_basket ? item.in_basket-- : item.price_all = item.in_basket * item.price_curs;
                        item.price_all = item.in_basket * item.price_curs;
                        return item;
                    })
                    this.price = prod.reduce(function (price, item) {
                        return price + item.price_all;
                    }, 0)
                },
                deep: true
            },
        },
        mounted() {
           let data =  this.basket.products
            axios({
                url: '/api/products-count',
                data,
                method: 'post',
            })
                .then((res) => {
                    if (res.data.status) {
                        let products = res.data.products
                        this.products = this.basket.products.map(item => {
                            item.count = products.find(it => it.id === item.id).count
                            return item;
                        })
                    }
                })
                .catch(function (error) {
                    console.log('Ошибка загрузки или обновлениея категории : ', error);
                });
        }
    }
</script>

<style lang="scss">
    .v-basket {
        .person {
            /*list-style: none;*/
        }
    }
    .custom-file-input:lang(ru) ~ .custom-file-label::after {
        content: 'Загрузить' !important;
    }
</style>