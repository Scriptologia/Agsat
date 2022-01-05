<template>
    <transition name="slide">
        <div>
            <h1>Права</h1>
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
                    :items="$store.state.permissions"
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
                <template #cell(edit)="row">
                    <b-icon-pencil @click="info(row.item, row.index, $event.target)" variant="primary" type="button"></b-icon-pencil>
                </template>
                <template #cell(delete)="row">
                    <b-icon-trash variant="danger" @click="deletePermission(row.item)" type="button"></b-icon-trash>
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
            <b-modal :id="infoModal.id" :title="infoModal.title" hide-footer @hide="resetInfoModal" size="lg">
                <v-permission-edit :permission="infoModal.content"></v-permission-edit>
            </b-modal>
        </div>
    </transition>
</template>

<script>
    // import vTable from '../components/v-table'
    // import axios from 'axios'
    import vPermissionEdit from '../components/v-permission-edit'
    import {mapActions} from 'vuex'

    export default {
        name: "v-permissions",
        components: {vPermissionEdit},
        data() {
            return {
                spinner: true,
                empty : {emptyText: 'ничего не найдено', emptyFilteredText: 'по этому запросу ничего не найдено'},
                perPage: 20,
                currentPage: 1,
                sortBy: 'id',
                sortDesc: false,
                fields: [
                    { key: 'id', sortable: true },
                    { key: 'slug', sortable: true, label:'Slug' },
                    { key: 'description', sortable: true, label:'Описание' },
                    { key: 'edit',  label:'Ред.' },
                    { key: 'delete',  label:'Уд.' },
                ],
                filter: null,
                filterOn: [],
                infoModal: {
                    id: 'permission-edit',
                    title: '',
                    content: ''
                }
            }
        },
        methods: {
            ...mapActions([
                'GET_PERMISSIONS'
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
                if(item.id)  {this.infoModal.title = `Редактирование права: ${item.slug}`;}
                else {this.infoModal.title = 'Создание прав'}
                this.infoModal.content =  item
                // this.infoModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = {}
            },
            deletePermission(item) {
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
                            axios.delete('/api/permission/' + item.id )
                                .then((res) => {
                                    this.makeToast(true, res.data.message, res.data.status);
                                    if(res.data.status)  {
                                        setTimeout(() => {this.GET_PERMISSIONS()}, 1000);
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
            this.GET_PERMISSIONS().then(() => {
                // this.permissions = this.$store.state.permissions
                    this.spinner = false
            });
        },
        computed: {
            rows() {
                return this.$store.state.permissions.length
            }
        }
    }
</script>

<style>

</style>