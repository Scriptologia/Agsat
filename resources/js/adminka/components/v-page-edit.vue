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
                                                        label=""
                                                        label-cols-sm="3"
                                                        label-align-sm="right"
                                                >
                                                    <b-form-checkbox v-model="visible" name="check-button" switch>Отображать страницу</b-form-checkbox>
                                                </b-form-group>
                                            <ckeditor :editor="editor" v-model="text_ru" :config="editorConfig"></ckeditor>
                                        </b-card-text>
                            </b-tab>
                            <b-tab title="Украинский">
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
                                            <ckeditor :editor="editor" v-model="text_uk" :config="editorConfig"></ckeditor>                                            <!--<Vueditor  v-model="text_ru"></Vueditor>-->
                                        </b-card-text>
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
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
    import vMediaManager from '../components/media-manager/v-media-manager'

    export default {
        name: "v-page-edit",
        components: {vMediaManager},
        props: {
            page: Object,
        },
        data() {
            return {
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },
                spinner: false,
                slug: this.page.slug,
                // images: this.page.img || [],
                name_ru: this.page.name_ru,
                description_ru: this.page.description_ru,
                text_ru: this.page.text_ru,
                tags_ru: this.page.tags_ru,
                name_uk: this.page.name_uk,
                description_uk: this.page.description_uk,
                text_uk: this.page.text_uk,
                tags_uk: this.page.tags_uk,
                visible: Object.keys(this.page).length ? this.page.visible : true,
                infoModal: {
                     id: 'media-manager-modal',
                    title: '',
                    content: ''
            },
                slugUrl: this.page.id ? '/' + this.page.slug : ''
            }
        },
        methods: {
            ...mapActions([
                'GET_PAGES'
            ]),
            ...mapMutations([
                'SET_MEDIA_SELECTED_FILES_TO_STATE'
            ]),
            makeMain(index, item){
                this.images.map((it, i) => {
                    i === index ? it.main = true : it.main = false;
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
                if(!this.images.find(it => it.main === true)) this.images[0].main = true;
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
                if (typeof message === 'object') {
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
                if (!this.name_uk) this.name_uk = this.name_ru;
                if (!this.description_uk) this.description_uk = this.description_ru;
                if (!this.text_uk) this.text_uk = this.text_ru;
                if (!this.tags_uk || this.tags_uk === null) this.tags_uk = this.tags_ru;
                let data = {
                    name_ru: this.name_ru,
                    description_ru: this.description_ru,
                    text_ru: this.text_ru,
                    tags_ru: this.tags_ru,
                    name_uk: this.name_uk,
                    description_uk: this.description_uk,
                    text_uk: this.text_uk,
                    tags_uk: this.tags_uk,
                    visible: this.visible,
                    slug: this.slug
                }
                axios({
                    url: '/api/pages' + this.slugUrl,
                    data,
                    method: this.slugUrl ? 'put' : 'post',
                })
                    .then((res) => {
                        this.makeToast(true, this.toastMessage(res.data.message), res.data.status);
                        if (res.data.status) {
                            this.GET_PAGES();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'page-edit')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея страницы : ', error);
                    });
            }
        },
        computed: {
            slugMake: function() {
                this.slug = this.slug || url_slug(this.name_ru)
                return this.slug ;
            },
        },
        watch: {
        },
        mounted() {
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
</style>