<template>
    <transition name="slide">
        <div>
            <!--<v-spinner v-if="spinner"></v-spinner>-->
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <b-card bg-variant="light">
                        <b-tabs pills card align="right">
                            <b-tab title="Русский" active>
                                <b-card-text>
                                    <validation-provider
                                            name="Фильтр"
                                            :rules="{ required: true, min: 3 }"
                                            v-slot="validationContext"
                                    >
                                        <b-form-group
                                                label="Фильтр:"
                                                label-for="name_ru"
                                                label-cols-sm="3"
                                                label-align-sm="right"
                                        >
                                            <b-form-input id="name_ru"
                                                          name="name_ru"
                                                          v-model="name_ru"
                                                          debounce="500"
                                                          :state="getValidationState(validationContext)"
                                                          aria-describedby="name_ru-feedback">
                                            </b-form-input>
                                            <b-form-invalid-feedback id="name_ru-feedback">{{
                                                validationContext.errors[0] }}
                                            </b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                    <validation-provider
                                            name="Slug"
                                            :rules="{ required: true, min: 3 }"
                                            v-slot="validationContext"
                                    >
                                    <b-form-group
                                                label="Slug:"
                                                label-for="slug"
                                                label-cols-sm="3"
                                                label-align-sm="right"
                                        >
                                            <b-form-input id="slug"
                                                          v-model="slug"
                                                          :value="slugMake"
                                                          debounce="500"
                                                          :state="getValidationState(validationContext)"
                                                          aria-describedby="slug-feedback">
                                                >
                                            </b-form-input>
                                            <b-form-invalid-feedback id="slug-feedback">{{ validationContext.errors[0]}}
                                            </b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>

                                    <h4 class="col-12" v-if="fields">Поля :</h4>
                                    <div class="row" v-for="(item, index) in fields" :key="index">
                                        <validation-provider class="col-sm p-1"
                                                name="Slug"
                                                :rules="{ required: true, min: 3 }"
                                                v-slot="validationContext"
                                        >
                                            <b-form-group
                                                    label="Slug:"
                                                    :label-for="'slug'+index"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-form-input :id="'slug'+index"
                                                              name="slug"
                                                              v-model="item.slug" :value="itemSlug(item)"
                                                              debounce="500"
                                                              :state="getValidationState(validationContext)"
                                                              aria-describedby="slug-feedback">
                                                </b-form-input>
                                                <b-form-invalid-feedback id="slug-feedback">{{validationContext.errors[0] }}
                                                </b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                        <validation-provider  class="col-sm p-1"
                                                name="Значение"
                                                :rules="{ required: true, min: 3 }"
                                                v-slot="validationContext"
                                        >
                                            <b-form-group
                                                    label="Значение:"
                                                    :label-for="'value_ru' + index"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-form-input :id="'value_ru' + index"
                                                              name="value_ru"
                                                              v-model="item.value_ru"
                                                              debounce="500"
                                                              :state="getValidationState(validationContext)"
                                                              aria-describedby="value_ru-feedback">
                                                </b-form-input>
                                                <b-form-invalid-feedback id="value_ru-feedback">{{validationContext.errors[0] }}
                                                </b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                        <div class="col-1 p-2">
                                            <b-icon-x-circle
                                                type="button"
                                                variant="danger"
                                                font-scale="2"
                                                @click="deleteField(item, index)"
                                        ></b-icon-x-circle>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <b-button pill variant="success" @click="addField">
                                            <b-icon-plus></b-icon-plus>  поле
                                        </b-button>
                                    </div>
                                    <b-form-group
                                            label=""
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-checkbox v-model="visible" name="check-button" switch>Отображать
                                            фильтр
                                        </b-form-checkbox>
                                    </b-form-group>
                                </b-card-text>
                            </b-tab>
                            <b-tab title="Украинский">
                                <b-card-text>
                                    <b-form-group
                                            label="Фильтр:"
                                            label-for=name_uk
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-input id="name_uk" v-model="name_uk" debounce="500"></b-form-input>
                                    </b-form-group>

                                    <h4 class="col-12" v-if="fields">Поля :</h4>
                                    <b-input-group v-for="(item, index) in fields" :key="index">
                                        <validation-provider
                                                               class="col-sm p-1"
                                                              name="Значение"
                                                              :rules="{ min: 3 }"
                                                              v-slot="validationContext"
                                        >
                                            <b-form-group
                                                    label="Значение:"
                                                    :label-for="'value_uk' + index"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-form-input :id="'value_uk' + index"
                                                              name="value_uk"
                                                              v-model="item.value_uk"
                                                              debounce="500"
                                                              aria-describedby="value_uk-feedback"
                                                              :state="getValidationState(validationContext)"
                                                              >
                                                </b-form-input>
                                                <b-form-invalid-feedback id="value_uk-feedback">{{validationContext.errors[0] }}
                                                </b-form-invalid-feedback>
                                            </b-form-group>
                                        </validation-provider>
                                        <div class="col-1 p-2">
                                            <b-icon-x-circle
                                                    type="button"
                                                    variant="danger"
                                                    font-scale="2"
                                                    @click="deleteField(item, index)"
                                            ></b-icon-x-circle>
                                        </div>
                                      </b-input-group>

                                    <div class="d-flex justify-content-end">
                                        <b-button pill variant="success" @click="addField">
                                            <b-icon-plus></b-icon-plus>  поле
                                        </b-button>
                                    </div>

                                </b-card-text>
                            </b-tab>
                        </b-tabs>
                        <div class="d-flex justify-content-end">
                            <!--<b-button class="ml-2" @click="resetForm()">Reset</b-button>-->
                            <b-button class="ml-2" type="submit" variant="success">Сохранить</b-button>
                        </div>
                    </b-card>
                </b-form>
            </validation-observer>
        </div>
    </transition>
</template>

<script>
    import axios from 'axios'
    import { url_slug } from 'cyrillic-slug'

    import {mapActions} from 'vuex'
    export default {
        name: "v-filter-edit",
        props: {
            filter: Object,
        },
        data() {
            return {
                spinner: true,
                id: this.filter.id || null,
                slug: this.filter.slug || null,
                fields: this.filter.fields || [],
                name_ru: this.filter.name_ru || null,
                name_uk: this.filter.name_uk || null,
                visible: Object.keys(this.filter).length ? this.filter.visible : true,
                slugUrl: this.filter.id ? '/' + this.filter.slug : ''
            }
        },
        methods: {
            ...mapActions([
                'GET_FILTERS'
            ]),
            deleteField(item, index) {
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
                            if(item.id) {//Object.keys(this.filter).length
                                axios.delete('/api/filter/' + item.slug )
                                    .then((res) => {
                                        this.makeToast(true, this.toastMessage(res.data.message), res.data.status);
                                        if(res.data.status)  {
                                            this.GET_FILTERS()
                                                .then((res) => {
                                                    this.fields = this.$store.state.filters.find(it => this.filter.slug === it.slug).fields
                                                })
                                               .catch((error) => {
                                                console.log(error);
                                                return error;
                                            })
                                        }
                                    })
                                    .catch((error) => {
                                        console.log(error);
                                        return error;
                                    });
                            }
                            else {
                                this.fields.splice(index, 1)
                            }
                        }
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            itemSlug (item) {
                item.slug = item.slug || url_slug(item.value_ru)
                return item.slug;
            },
            addField (){
                this.fields.push({value_ru:'', value_uk: '', slug: '' , id: '', filter_id: ''})
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
            onSubmit() {
                if (!this.name_uk) this.name_uk = this.name_ru;
                this.fields.forEach(function(item)  {
                   if(!item.value_uk) item.value_uk = item.value_ru;
                })
                let  data = {'id' : this.id, 'name_ru' : this.name_ru, 'name_uk' : this.name_uk, 'slug' : this.slug, 'fields' : this.fields, 'visible' : this.visible};
                axios({
                    url: 'http://agsat/api/filter' + this.slugUrl,
                    data,
                    method: this.slugUrl ? 'put' : 'post',
                    // {
                    //     headers: {
                    //         'Content-Type': 'multipart/form-data'
                    //     }
                    // }
                })
                    .then((res) => {
                        this.makeToast(true,  this.toastMessage(res.data.message), res.data.status);
                        if (res.data.status) {
                            this.GET_FILTERS();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'filter-edit')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея фильтра : ', error);
                    });
            }
        },
        computed: {
            slugMake: function () {
                this.slug = this.slug || url_slug(this.name_ru)
                return this.slug;
            }
        },
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
    .custom-file-input:lang(ru) ~ .custom-file-label::after {
        content: 'Загрузить' !important;
    }
</style>