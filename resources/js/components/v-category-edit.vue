<template>
    <transition name="slide">
        <div>
            <v-spinner v-if="spinner"></v-spinner>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <b-card bg-variant="light">
                        <b-tabs pills card align="right">
                            <b-tab title="Русский" active>
                                <b-card-text>
                                    <validation-provider
                                            name="Категория"
                                            :rules="{ required: true, min: 3 }"
                                            v-slot="validationContext"
                                    >
                                        <b-form-group
                                                label="Категория:"
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
                                    <b-form-group
                                            label="Родительская категория:"
                                            label-for="category_id"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-select v-model="category_id"
                                                       :options="categories"
                                                       value-field="id"
                                                       text-field="name">
                                            <template #first>
                                                <b-form-select-option :value="null">Корневая категория
                                                </b-form-select-option>
                                            </template>
                                        </b-form-select>
                                    </b-form-group>
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
                                                          v-model="slug" :value="slugMake"
                                                          debounce="500"
                                                          :state="getValidationState(validationContext)"
                                                          aria-describedby="slug-feedback">
                                                >
                                            </b-form-input>
                                            <b-form-invalid-feedback id="slug-feedback">{{ validationContext.errors[0]}}
                                            </b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                    <b-form-group
                                            label="Фильтры:"
                                            label-for="filters"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <multiselect input-id="filters" v-model="filtersObj" multiple
                                                     :options="filterOptions" label="name_ru" track-by="id">
                                        </multiselect>
                                    </b-form-group>
                                    <b-form-group
                                            label="Описание:"
                                            label-for="description_ru"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-input id="description_ru" v-model="description_ru"
                                                      debounce="500"></b-form-input>
                                    </b-form-group>
                                    <b-form-group
                                            label="Тэги:"
                                            label-for="tags_ru"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-tags input-id="tags_ru" v-model="tags_ru"></b-form-tags>
                                    </b-form-group>
                                    <validation-provider
                                            rules="image" v-slot="{ errors, validate }" name="Изображение">
                                        <b-form-group
                                                label="Изображение"
                                                label-cols-sm="3"
                                                label-align-sm="right"
                                        >
                                            <b-form-file
                                                    v-model="img"
                                                    type="file"
                                                    accept="image/*"
                                                    :state="!Boolean(errors.length)"
                                                    placeholder="Выберите файл или перетяните его сюда..."
                                                    drop-placeholder="Перетяните сюда..."
                                                    @change=" validate"></b-form-file>
                                            <span>{{ errors[0] }}</span>
                                            <b-img center :src="imgSrc" :alt="imgSrc.name" v-if="img"
                                                   style="width:200px;" class="mt-3"></b-img>
                                        </b-form-group>
                                    </validation-provider>
                                    <b-form-group
                                            label="Скидка"
                                            label-for="skidka"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-input input-id="skidka" v-model.number="skidka" type="number" max="100"
                                                      step=".01"
                                                      min="0"></b-form-input>
                                    </b-form-group>
                                    <b-form-group
                                            label=""
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-checkbox v-model="visible" name="check-button" switch>Отображать
                                            категорию
                                        </b-form-checkbox>
                                    </b-form-group>
                                </b-card-text>
                            </b-tab>
                            <b-tab title="Украинский">
                                <b-card-text>
                                    <b-form-group
                                            label="Категория:"
                                            label-for=name_uk
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-input id="name_uk" v-model="name_uk" debounce="500"></b-form-input>
                                    </b-form-group>
                                    <b-form-group
                                            label="Описание:"
                                            label-for="description_uk"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-input id="description_uk" v-model="description_uk"
                                                      debounce="500"></b-form-input>
                                    </b-form-group>
                                    <b-form-group
                                            label="Тэги:"
                                            label-for="tags_uk"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                    >
                                        <b-form-tags input-id="tags_uk" v-model="tags_uk"></b-form-tags>
                                    </b-form-group>
                                </b-card-text>
                            </b-tab>
                        </b-tabs>
                        <div class="d-flex justify-content-end">
                            <b-button class="ml-2" @click="resetForm()">Reset</b-button>
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
    import {mapActions} from 'vuex'
    import { url_slug } from 'cyrillic-slug'

    export default {
        name: "v-category-edit",
        props: {
            category: Object, filterOptions: Array, categories: Array
        },
        data() {
            return {
                spinner: false,
                slug: this.category.slug,
                skidka: Object.keys(this.category).length ? this.category.skidka : 0,
                filters: [],
                filtersObj: [],
                img: this.category.img,
                prev: '',
                category_id: this.category.category_id,
                name_ru: this.category.name_ru,
                description_ru: this.category.description_ru,
                tags_ru: this.category.tags_ru,
                name_uk: this.category.name_uk,
                description_uk: this.category.description_uk,
                tags_uk: this.category.tags_uk,
                visible: Object.keys(this.category).length ? this.category.visible : true,
                slugUrl: this.category.id ? '/' + this.category.slug : ''
            }
        },
        methods: {
            ...mapActions([
                'GET_CATEGORIES'
            ]),
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
            resetForm() {
                this.img = null;
                this.prev = null;

                this.$nextTick(() => {
                    this.$refs.observer.reset();
                });
            },
            onSubmit() {
                if (!this.name_uk) this.name_uk = this.name_ru;
                if (!this.description_uk) this.description_uk = this.description_ru;
                if (!this.tags_uk || this.tags_uk === null) this.tags_uk = this.tags_ru;
                this.filters = this.filtersObj.map(item => item.id);
                let items = Object.assign({}, this.$data)
                items.visible = items.visible ? 1 : 0;
                let formData = new FormData();
                for (let k in items) {
                    if (items[k] !== undefined && items[k] !== null && k !== 'spinner' && k !== 'prev' && k !== 'slugUrl' && k !== 'filtersObj') {
                        if (k === 'filters' || k === 'tags_ru' || k === 'tags_uk') {
                            items[k] = JSON.stringify(items[k]);
                        }
                        formData.append(k, items[k]);
                    }
                }
                axios.post('http://agsat/api/category' + this.slugUrl,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                )
                    .then((res) => {
                        this.makeToast(true,  this.toastMessage(res.data.message), res.data.status);
                        if (res.data.status) {
                            this.GET_CATEGORIES();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'category-edit')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея категории : ', error);
                    });
            }
        },
        computed: {
            imgSrc: function () {
                if (this.img) {
                    var reader = new FileReader();
                    let vm = this;
                    reader.readAsDataURL(vm.img);
                    reader.onload = function (e) {
                        vm.prev = e.target.result;
                    }
                    return this.prev;
                }
            },
            slugMake: function() {
                this.slug = this.slug || url_slug(this.name_ru)
                return this.slug ;
            }
        },
        watch: {
            // filtersObj: function () {
            //     this.filters = this.filtersObj.map(item => item.id)
            // },
            skidka: function () {
                this.skidka = this.skidka > 100 ? 100 : this.skidka;
            }
        },
        mounted() {
            if(Object.keys(this.category).length) this.filtersObj = this.filterOptions.filter(item => this.category.filters.includes(item.id));
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
    .custom-file-input:lang(ru) ~ .custom-file-label::after {
        content: 'Загрузить' !important;
    }
</style>