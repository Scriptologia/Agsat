<template>
    <transition name="slide">
        <div>
            <v-spinner v-if="spinner"></v-spinner>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <b-card bg-variant="light">
                        <b-tabs pills card align="right">
                            <b-tab title="Русский" active>
                                <b-tabs card>
                                    <b-tab title="Общая инф." active>
                                        <b-card-text>
                                            <validation-provider
                                                    name="Название"
                                                    :rules="{ required: true, min: 3 }"
                                                    v-slot="validationContext"
                                            >
                                                <b-form-group
                                                        label="Название:"
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
                                                    label="Категория:"
                                                    label-for="category_id"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-form-select v-model="category">
                                                    <b-form-select-option :value="{}">Корневая категория
                                                    </b-form-select-option>
                                                    <b-form-select-option :value="category"
                                                                          v-for="(category,index) in categories"
                                                                          :key="index">{{category.name}}
                                                    </b-form-select-option>
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
                                                    <b-form-invalid-feedback id="slug-feedback">{{
                                                        validationContext.errors[0]}}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <b-form-group
                                                    label="Описание для SEO:"
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

                                            <b-form-group
                                                    label="Скидка"
                                                    label-for="skidka"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-form-input
                                                        input-id="skidka"
                                                        type="number"
                                                        v-model.number="skidka"
                                                        min="0"
                                                        max="100"
                                                        step=".01"
                                                       >
                                                </b-form-input>
                                            </b-form-group>
                                            <b-form-group
                                                    label="Цена"
                                                    label-for="price"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-input-group>
                                                    <b-form-input input-id="price" v-model.number="price" type="number"
                                                                  step=".01"
                                                                  min="0"></b-form-input>
                                                    <template #append>
                                                        <b-form-select v-model="curs_id"
                                                                       :options="curses"
                                                                       value-field="id"
                                                                       text-field="name"
                                                        >
                                                            <template #first>
                                                                <b-form-select-option selected disabled value="null">
                                                                    Валюта
                                                                </b-form-select-option>
                                                            </template>
                                                        </b-form-select>
                                                    </template>
                                                </b-input-group>
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
                                    <b-tab title="Описание">
                                        <b-card-text>
                                            <ckeditor :editor="editor" v-model="text_ru" :config="editorConfig"></ckeditor>
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Изображения">
                                        <b-card-text>
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
                                                    <!--<b-img center :src="imgSrc" :alt="imgSrc.name" v-if="img"-->
                                                    <!--style="width:200px;" class="mt-3"></b-img>-->
                                                </b-form-group>
                                            </validation-provider>
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Фильтры" :disabled="!filtersOfCategory.length">
                                        <b-card-text>
                                            <b-form-group :label="filter.name_ru" v-slot="{ ariaDescribedby }"
                                                          v-for="(filter, index) in filtersOfCategory" :key="index">
                                                 <b-form-radio-group v-model="fields['field'+filter.id]">
                                                <b-form-radio
                                                v-for="(field , key) in filter.fields"
                                                :key="key"
                                                :name="'filter' + index+'[]'"
                                                :value="field.id"
                                                >{{field.value_ru}}</b-form-radio>
                                            <!--<b-form-radio-group-->
                                                    <!--v-model="fields[index]"-->
                                                    <!--:options="filter.fields"-->
                                                    <!--:checked="checkedFields"-->
                                                    <!--class="mb-3"-->
                                                    <!--value-field="id"-->
                                                    <!--text-field="value_ru"-->
                                                    <!--disabled-field="notEnabled"-->
                                                    <!--:aria-describedby="ariaDescribedby"-->
                                            <!--&gt;</b-form-radio-group>-->
                                            </b-form-radio-group>
                                            </b-form-group>
                                        </b-card-text>
                                    </b-tab>
                                </b-tabs>
                            </b-tab>
                            <b-tab title="Украинский">
                                <b-tabs card>
                                    <b-tab title="Общая инф." active>
                                        <b-card-text>
                                              <b-form-group
                                                        label="Название:"
                                                        label-for="name_uk"
                                                        label-cols-sm="3"
                                                        label-align-sm="right"
                                                >
                                                    <b-form-input id="name_uk"
                                                                  name="name_uk"
                                                                  v-model="name_uk"
                                                                  debounce="500">
                                                    </b-form-input>
                                                </b-form-group>
                                            <b-form-group
                                                    label="Описание для SEO:"
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
                                    <b-tab title="Описание">
                                        <b-card-text>
                                            <ckeditor :editor="editor" v-model="text_uk" :config="editorConfig"></ckeditor>                                            <!--<Vueditor  v-model="text_ru"></Vueditor>-->
                                        </b-card-text>
                                    </b-tab>
                                </b-tabs>
                            </b-tab>
                        </b-tabs>
                        <div class="d-flex justify-content-end">
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
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        name: "v-product-edit",
        props: {
            product: Object, categories: Array, curses: Array,
        },
        data() {
            return {
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },
                spinner: false,
                slug: this.product.slug,
                skidka: this.product.skidka || 0,
                img: this.product.img || [],
                category: {},
                fields: {},//this.product.filters ? this.product.filters.map(it => {return [`${it.filter_iD}` : it.id]}) : [],
                name_ru: this.product.name_ru,
                description_ru: this.product.description_ru,
                text_ru: this.product.text_ru,
                tags_ru: this.product.tags_ru,
                name_uk: this.product.name_uk,
                description_uk: this.product.description_uk,
                text_uk: this.product.text_uk,
                tags_uk: this.product.tags_uk,
                curs_id: this.product.curs_id,
                price: this.product.price || 0,
                count: this.product.count || 0,
                visible: Object.keys(this.product).length ? this.product.visible : true,
                slugUrl: this.product.id ? '/' + this.product.slug : ''
            }
        },
        methods: {
            ...mapActions([
                'GET_PRODUCTS', 'GET_FILTERS'
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
            onSubmit() {
                let fields = Object.values(this.fields)
                // this.fields[Symbol.iterator] = function() {
                //     return {
                //         current: this.from,
                //         last: this.to,
                //         next() {
                //             if (this.current <= this.last) {
                //                 return { done: false, value: this.current++ };
                //             } else {
                //                 return { done: true };
                //             }
                //         }
                //     };
                // };

                // let chars = []
                // for (let field of this.fields) {
                //     chars.push(this.fields[field]);
                // }
                // this.fields = this.fields.filter(item  => item !== 'undefined');
                if (!this.name_uk) this.name_uk = this.name_ru;
                if (!this.description_uk) this.description_uk = this.description_ru;
                if (!this.text_uk) this.text_uk = this.text_ru;
                if (!this.tags_uk || this.tags_uk === null) this.tags_uk = this.tags_ru;
                let data = {
                    name_ru: this.name_ru, description_ru: this.description_ru, text_ru: this.text_ru, tags_ru: this.tags_ru ,
                    name_uk: this.name_uk, description_uk: this.description_uk, text_uk: this.text_uk, tags_uk: this.tags_uk ,
                    category_id: this.category.id, skidka: this.skidka, price: this.price, count: this.count, curs_id: this.curs_id, visible: this.visible, type: 'product',
                    fields: fields, img: this.img, slug: this.slug
                }
                axios({
                    url : 'http://agsat/api/product' +this.slugUrl,
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
                            this.GET_PRODUCTS();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'product-edit')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея товара : ', error);
                    });
            }
        },
        computed: {
            filtersOfCategory() {
                // this.fields = []
                if(Object.keys(this.category).length) {
                    let obj = this;
                    return this.$store.state.filters.filter(function(item) {
                        return obj.category.filters.indexOf( item.id ) !== -1;
                    })
                }
                return [];
            },
            slugMake: function() {
                this.slug = this.slug || url_slug(this.name_ru)
                return this.slug ;
            }
        },
        watch: {
            skidka: function () {
                this.skidka = this.skidka > 100 ? 100 : this.skidka
                let  arr = this.skidka.toString().split( '.' )
                this.skidka = arr.length === 2 && arr[1].length > 2? this.$options.filters.floatNumber(this.skidka, 2) : this.skidka
            },
            price: function () {
                let  arr = this.price.toString().split( '.' )
                this.price = arr.length === 2 && arr[1].length > 2? this.$options.filters.floatNumber(this.price, 2) : this.price
            }
        },
        mounted() {
            this.GET_FILTERS()
            let obj = this
            this.category = this.categories.find(it =>  it.id === obj.product.category_id)
            console.log(this.fields)
            if(this.product && this.product.filters){
                let arr = {}
                this.product.filters.forEach(it => {
                    arr['field'+it.filter_id] = it.id
                })
                console.log(arr)
                this.fields = arr
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
    .custom-file-input:lang(ru) ~ .custom-file-label::after {
        content: 'Загрузить' !important;
    }
    :root {
        --ck-z-default: 100;
        --ck-z-modal: calc( var(--ck-z-default) + 999 );
    }
    .product-edit {user-focus: false}
</style>