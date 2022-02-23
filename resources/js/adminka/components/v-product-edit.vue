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
                                            <validation-provider
                                                    name="Категория"
                                                    rules="required"
                                                    v-slot="validationContext"
                                            >
                                            <b-form-group
                                                    label="Категория:"
                                                    label-for="category"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <multiselect input-id="category" v-model="category" multiple
                                                             :options="categories" label="name_ru" track-by="id" :hide-selected="true" :allow-empty="false"
                                                             :state="getValidationState(validationContext)"
                                                             aria-describedby="category-feedback">
                                                </multiselect>
                                                <b-form-invalid-feedback id="category-feedback">{{
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
                                                    label="На складе"
                                                    label-for="count"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-form-input
                                                        input-id="count"
                                                        type="number"
                                                        v-model.number="count"
                                                        min="0"
                                                        step="1"
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
                                                                  min="0">
                                                    </b-form-input>
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
                                            <ckeditor :editor="editor" @ready="onReady" v-model="text_ru" :config="editorConfig"></ckeditor>
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Изображения">
                                        <b-card-text>
                                            <b-col class="product_files">
                                                <p v-if="!images.length">Нет файлов</p>
                                                <div v-else class="product_files_items">
                                                    <div v-for="(img, index) in images"
                                                         :key="index"
                                                         class="product_files_item selected"
                                                    >
                                                        <img :src="img.img" >
                                                        <b-icon-x-circle-fill
                                                                variant="danger" class="selected"
                                                                font-scale="2"
                                                                @click="removeSelected(index, img)" title="Удалить"
                                                        >
                                                        </b-icon-x-circle-fill>
                                                        <span class="selected_main" @click="makeMain(index, img)" v-b-tooltip.hover title="Сделать главной"></span>
                                                        <b-icon-check
                                                                v-if="img.main"
                                                                variant="success" class="main"
                                                                font-scale="2" title="Сделать главной"
                                                        >
                                                        </b-icon-check>
                                                    </div>
                                                </div>
                                            </b-col>
                                            <b-button  variant="info" @click="info({}, 0, $event.target)"><b-icon-plus></b-icon-plus>Добавить</b-button>
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Фильтры" :disabled="!filtersOfCategory.length">
                                        <b-card-text>
                                            <b-form-group :label="filter.name_ru" v-slot="{ ariaDescribedby }"
                                                          v-for="(filter,index) in filtersOfCategory" :key="index">
                                                 <b-form-radio-group v-model="fields['field'+filter.id]">
                                                <b-form-radio
                                                v-for="(field , key) in filter.fields"
                                                :key="key"
                                                :name="'filter' + index+'[]'"
                                                :value="field.id"
                                                >{{field.value_ru}}</b-form-radio>
                                            </b-form-radio-group>
                                            </b-form-group>
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Доп.товары">
                                        <b-card-text>
                                            <b-form-group
                                                    label="Категория:"
                                                    label-for="category_id"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-form-select v-model="categoryDopProducts">
                                                    <b-form-select-option :value="{}">Корневая категория
                                                    </b-form-select-option>
                                                    <b-form-select-option :value="category"
                                                                          v-for="(category,index) in categories"
                                                                          :key="index">{{category.name}}
                                                    </b-form-select-option>
                                                </b-form-select>
                                            </b-form-group>
                                            <b-form-group
                                                             label="Доп.товары:"
                                                             label-for="dop-products"
                                                             label-cols-sm="3"
                                                             label-align-sm="right"
                                                     >
                                                         <multiselect input-id="dop-products" v-model="dopProducts" multiple
                                                                      :options="productsOfCategory" label="name_ru" track-by="id">
                                                         </multiselect>
                                                     </b-form-group>
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Доп.услуги">
                                        <b-card-text>
                                            <b-form-group
                                                    label="Услуги:"
                                                    label-for="service_id"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-form-select v-model="service_id">
                                                    <b-form-select-option :value="null">Без доп.услуги
                                                    </b-form-select-option>
                                                    <b-form-select-option :value="service.id"
                                                                          v-for="(service,index) in $store.state.services"
                                                                          :key="index">{{service.name_ru}}
                                                    </b-form-select-option>
                                                </b-form-select>
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
                                            <ckeditor :editor="editor" @ready="onReady" v-model="text_uk" :config="editorConfig"></ckeditor>
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
            <b-modal
                    :id="infoModal.id"
                    :title="infoModal.title"
                    ok-only
                    @hide="resetInfoModal"
                    size="lg"
                    no-enforce-focus
                    @ok="addSelectedFiles"
                    ok-variant="success"
                    ok-title="Сохранить"
                    @hidden="clearSelected()"
            >
                <v-media-manager></v-media-manager>
            </b-modal>
        </div>
    </transition>
</template>

<script>
    import {mapActions, mapMutations} from 'vuex'
    import { url_slug } from 'cyrillic-slug'
    import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';
    import vMediaManager from '../components/media-manager/v-media-manager'

    export default {
        name: "v-product-edit",
        components: {vMediaManager},
        props: {
            product: Object, categories: Array, curses: Array,
        },
        data() {
            return {
                editor: DecoupledEditor,
                editorConfig: {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'alignment', '|',
                            'bold', 'italic', 'strikethrough', 'underline', '|',
                            'link', '|',
                            'bulletedList', 'numberedList',
                            'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
                            'insertTable', '|',
                            'outdent', 'indent', '|',
                            'blockQuote', '|',
                            'undo', 'redo'
                        ],
                        shouldNotGroupWhenFull: true
                     },
                        removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
                           },
                spinner: false,
                dopProducts: [],
                categoryDopProducts: '',
                productsOfCategory:[],
                slug: this.product.slug,
                skidka: this.product.skidka || 0,
                images: this.product.img || [],
                category: this.product.categories ? this.product.categories : this.categories[0],
                service_id: this.product.service_id || null,
                fields: {},
                name_ru: this.product.name_ru,
                description_ru: this.product.description_ru,
                text_ru: this.product.text_ru,
                tags_ru: this.product.tags_ru,
                name_uk: this.product.name_uk,
                description_uk: this.product.description_uk,
                text_uk: this.product.text_uk,
                tags_uk: this.product.tags_uk,
                curs_id: this.product.curs_id || this.curses.find(it => it.base).id,
                price: this.product.price || 0,
                count: this.product.count || 0,
                visible: Object.keys(this.product).length ? this.product.visible : true,
                infoModal: {
                     id: 'media-manager-modal',
                    title: '',
                    content: ''
            },
                slugUrl: this.product.id ? '/' + this.product.slug : ''
            }
        },
        methods: {
            onReady( editor )  {
                // Insert the toolbar before the editable area.
                editor.ui.getEditableElement().parentElement.insertBefore(
                    editor.ui.view.toolbar.element,
                    editor.ui.getEditableElement()
                );
            },
            ...mapActions([
                'GET_PRODUCTS', 'GET_FILTERS', 'GET_SERVICES'
            ]),
            ...mapMutations([
                'SET_MEDIA_SELECTED_FILES_TO_STATE'
            ]),
            makeMain(index, item){
                this.images.map((it, i) => {
                    i == index ? it.main = true : it.main = false;
                    return item;
                })
            },
            removeSelected(index, item){
                this.images.splice(index, 1)
            },
            clearSelected(){this.SET_MEDIA_SELECTED_FILES_TO_STATE()},
            addSelectedFiles(){
                let arr = this.$store.state.mediaFilesSelected.map(function (item) {
                    return {img: item.img, main: false}
                })
                this.images = [...this.images, ...arr]
                if(!this.images.find(it => it.main == true)) this.images[0].main = true;
                this.SET_MEDIA_SELECTED_FILES_TO_STATE()
            },
            info(item, index, button) {
                this.infoModal.title = 'Медиа менеджер';
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = {}
            },
            toastMessage(message) {
                let str = '';
                if (typeof message == 'object') {
                    for (const [p, val] of Object.entries(message)) {
                        str += `${p}:${val.join(' \n ')}\n`;
                    }
                } else {
                    str = message;
                }
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
                let filters = this.filtersOfCategory.map(it => 'field'+it.id)
                for (let k in this.fields) {
                    if(filters.indexOf(k) === -1) {delete this.fields[k]}
                }
                let fields = Object.values(this.fields)
                if (!this.name_uk) this.name_uk = this.name_ru;
                if (!this.description_uk) this.description_uk = this.description_ru;
                if (!this.text_uk) this.text_uk = this.text_ru;
                if (!this.tags_uk || this.tags_uk == null) this.tags_uk = this.tags_ru;
                let dop_products = this.dopProducts && this.dopProducts.length? this.dopProducts.map(item => item.id) : null;
                let data = {
                    dop_products: dop_products,
                    name_ru: this.name_ru,
                    description_ru: this.description_ru,
                    text_ru: this.text_ru,
                    tags_ru: this.tags_ru,
                    name_uk: this.name_uk,
                    description_uk: this.description_uk,
                    text_uk: this.text_uk,
                    tags_uk: this.tags_uk,
                    category_id: this.category.map(it => it.id),
                    skidka: this.skidka,
                    price: this.price,
                    count: this.count,
                    curs_id: this.curs_id,
                    visible: this.visible,
                    type: 'product',
                    fields: fields,
                    img: this.images,
                    slug: this.slug
                }
                if(this.service_id) data.service_id = this.service_id;
                    axios({
                    url: '/api/product' + this.slugUrl,
                    data,
                    method: this.slugUrl ? 'put' : 'post',
                })
                    .then((res) => {
                        this.makeToast(true, this.toastMessage(res.data.message), res.data.status);
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
                if(this.category.length) {
                // if(Object.keys(this.category).length) {
                    let objt = this;
                    let arr = []
                    function findParent (category_id, arr){
                        let obj = objt.categories.find(it => it.id == category_id)
                        if (obj !== undefined){
                            if (obj.filters !== null) {arr = arr.concat(obj.filters);}
                            return findParent(obj.category_id, arr)
                        }
                        return arr;
                    }
                    if(this.category){
                        arr = this.category.map(it => findParent(it.id, arr)).flat()
                    }
                    return this.$store.state.filters.filter(function(item) {return arr.indexOf(item.id) !== -1});
                }
                return [];
            },
            slugMake: function() {
                this.slug = this.slug || url_slug(this.name_ru)
                return this.slug ;
            },
        },
        watch: {
            skidka: function () {
                this.skidka = this.skidka > 100 ? 100 : this.skidka
                let  arr = this.skidka.toString().split( '.' )
                this.skidka = arr.length == 2 && arr[1].length > 2? this.$options.filters.floatNumber(this.skidka, 2) : this.skidka
            },
            price: function () {
                let  arr = this.price.toString().split( '.' )
                this.price = arr.length == 2 && arr[1].length > 2? this.$options.filters.floatNumber(this.price, 2) : this.price
            },
            categoryDopProducts: function () {
                axios.get(
                    '/api/get-products-of-category/' + this.categoryDopProducts.slug
                )
                    .then((res) => {
                            this.productsOfCategory = res.data.products
                    })
                    .catch(function (error) {
                        console.log('Ошибка получения товаров по категории: ', error);
                    });
            }
        },
        mounted() {
            this.GET_FILTERS()
            if(this.product.slug !== undefined){
                axios.get(
                    '/api/get-dop-products/' + this.product.slug
                )
                    .then((res) => {
                        this.dopProducts = res.data.dopProducts
                    })
                    .catch(function (error) {
                        console.log('Ошибка получения доп.товаров: ', error);
                    });}

            // let obj = this
            // if(this.product.length) {
            // // if(Object.keys(this.product).length) {
            //     let category = this.categories.find(it =>  it.id == obj.product.category_id)
            //     this.category = typeof  category !== 'undefined'? category : {}
            // }

            if(this.product && this.product.filters){
                let arr = {}
                this.product.filters.forEach(it => {
                    arr['field'+it.filter_id] = it.id
                })
                this.fields = arr
            }
        }
    }
</script>

<style lang="scss">
    .product_files {
    &_items {display: flex;flex-wrap: wrap;}
    &_item {
         width:100px;height:100px;
         border: 1px solid #a0aec0;
        margin:.5rem .5rem 1.5rem .5rem ;
         position: relative;
         box-shadow: 0 0 8px 0 #627f83;
    &.selected:before {
        content: "";
        position: absolute;
        right: 0;
        top: 0;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background: white;
        transform: translate(50%, -50%);
     }
    & .selected_main {
            content: "";
            position: absolute;
            bottom: 0;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background: white;
            border: 1px solid green;
            transform: translate(-50%, 50%);
            cursor: pointer;
        }
    & img {
          object-fit: cover;
          width: 100%;
          height: 100%;
      }
    & .selected {
          position: absolute;
        transform: translate(-50%, -50%);
        cursor: pointer;
      }
    & .main {
        bottom:0;
        /*right:0;*/
        position: absolute;
        transform: translate(-50%, 50%);
      }
    }
    }
    .custom-file-input:lang(ru) ~ .custom-file-label::after {
        content: 'Загрузить' !important;
    }
    :root {
        --ck-z-default: 100;
        --ck-z-modal: calc( var(--ck-z-default) + 999 );
    }
    .product-edit {user-focus: false}
    .ck {
        &-content {
            background: white;
        }
    }
</style>