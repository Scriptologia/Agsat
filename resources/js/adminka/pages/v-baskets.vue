<template>
    <transition name="slide">
        <div>
            <!--<v-spinner />-->
            <h1>Заказы</h1>
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
                    :items="$store.state.baskets"
                    :per-page="perPage"
                    :current-page="currentPage"
                    :fields="fields"
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
                <template #cell(is_closed)="row">
                    <span v-if="row.item.is_closed" class="green">Закрыт</span>
                    <span v-else class="blue">Открыт</span>
                </template>
                <template #cell(delete)="row">
                    <b-icon-trash variant="danger" @click="deleteBasket(row.item)" type="button"  v-if="!row.item.is_closed"></b-icon-trash>
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
            <b-modal :id="infoModal.id" :title="infoModal.title" hide-footer @hide="resetInfoModal" size="xl">
                <v-basket-edit :basket="infoModal.content"></v-basket-edit>
            </b-modal>
        </div>
    </transition>
</template>

<script>
    import vBasketEdit from '../components/v-basket-edit'
    import {mapActions} from 'vuex'
    export default {
        name: "v-baskets",
        components: {vBasketEdit},
        data() {
            return {
                spinner: true,
                empty : {emptyText: 'ничего не найдено', emptyFilteredText: 'по этому запросу ничего не найдено'},
                perPage: 20,
                currentPage: 1,
                // sortBy: 'id',
                sortDesc: false,
                fields: [
                    { key: 'id', sortable: true },
                    { key: 'person.name', sortable: true, label: 'ФИО' },
                    { key: 'person.phone', sortable: true, label:'Телефон'},
                    { key: 'price', sortable: true, label:'Стоимость, грн.' },
                    { key: 'is_closed', sortable: true, label:'Закрыт'},
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
                if(item.id)  {this.infoModal.title = `Редактирование заказа: Артикул -  ${item.id}`;}
                else {this.infoModal.title = 'Создание заказа'}
                this.infoModal.content =  item
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = {}
            },
            deleteBasket(item) {
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
                            axios.delete('/api/baskets/' + item.id )
                                .then((res) => {
                                    this.makeToast(true, res.data.message, res.data.status);
                                    if(res.data.status)  {
                                        setTimeout(() => {this.GET_BASKETS()}, 1000);
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
            }
        },
        mounted(){
            this.spinner = true
            this.GET_BASKETS().then(() => {
                this.spinner = false
            });
        },
        computed: {
            rows() {
                return this.$store.state.baskets.length
            },
        }
    }
</script>

<style lang="scss">
    .green { color:green;}
    .blue { color:blue;}
</style>