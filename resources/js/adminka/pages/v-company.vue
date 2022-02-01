<template>
    <transition name="slide">
        <div>
            <h1>О компании</h1>
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
                                                        label-for="name"
                                                        label-cols-sm="3"
                                                        label-align-sm="right"
                                                >
                                                    <b-form-input id="name"
                                                                  name="name"
                                                                  v-model="company.name"
                                                                  debounce="500"
                                                                  :state="getValidationState(validationContext)"
                                                                  aria-describedby="name-feedback">
                                                    </b-form-input>
                                                    <b-form-invalid-feedback id="name-feedback">{{
                                                        validationContext.errors[0] }}
                                                    </b-form-invalid-feedback>
                                                </b-form-group>
                                            </validation-provider>
                                            <b-form-group
                                                    label="Телефоны:"
                                                    label-for="phones"
                                                    label-cols-sm="3"
                                                    label-align-sm="right"
                                            >
                                                <b-form-tags input-id="phones" v-model="company.phones"></b-form-tags>
                                            </b-form-group>
                                            <h4 class="col-12" >Соц.сети :</h4>
                                            <div class="row justify-content-end" v-for="(item, index) in company.socials" :key="index" v-if="company.socials.length">
                                                    <b-dropdown id="dropdown" text="Иконки" class="m-2">
                                                        <b-dropdown-item v-for="(soc,index) in $store.state.mediaFiles" :key="index" @click="item.img = soc.img" :class="{'bg-info': item.img === soc.img}">
                                                            <img :src="soc.img">
                                                        </b-dropdown-item>
                                                    </b-dropdown>
                                                <validation-provider
                                                        name="Название"
                                                        :rules="{ required: true }"
                                                        v-slot="validationContext"
                                                >
                                                <b-form-group
                                                            label="Название:"
                                                            :label-for="'name'+index"
                                                            label-cols-sm="4"
                                                            label-align-sm="right"
                                                    >
                                                        <b-form-input :id="'name'+index"
                                                                      name="slug"
                                                                      v-model="item.name"
                                                                      debounce="500"
                                                                      :state="getValidationState(validationContext)"
                                                                      aria-describedby="name-feedback">
                                                        </b-form-input>
                                                    <b-form-invalid-feedback id="name-feedback">
                                                        {{validationContext.errors[0] }}
                                                    </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                                <validation-provider
                                                        name="Адрес"
                                                        :rules="{ required: true }"
                                                        v-slot="validationContext"
                                                >
                                                <b-form-group
                                                            label="Адрес:"
                                                            :label-for="'url' + index"
                                                            label-cols-sm="4"
                                                            label-align-sm="right"
                                                    >
                                                        <b-form-input :id="'url' + index"
                                                                      name="value_ru"
                                                                      v-model="item.url"
                                                                      debounce="500"
                                                                      :state="getValidationState(validationContext)"
                                                                      aria-describedby="name-feedback">
                                                        </b-form-input>
                                                    <b-form-invalid-feedback id="name-feedback">{{
                                                        validationContext.errors[0] }}
                                                    </b-form-invalid-feedback>
                                                    </b-form-group>
                                                </validation-provider>
                                                <div class="col-1 justify-content-sm-end p-2">
                                                    <b-icon-x-circle
                                                            type="button"
                                                            variant="danger"
                                                            font-scale="2"
                                                            @click="deleteSocial(index)"
                                                    ></b-icon-x-circle>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <b-button pill variant="success" @click="addSocial">
                                                    <b-icon-plus></b-icon-plus>  сеть
                                                </b-button>
                                            </div>
                                            <h4 class="col-12">Время работы :</h4>
                                            <div class="row">
                                                <b-form-group class="col-sm-6"
                                                            label="Начало работы:"
                                                            label-for="start"
                                                            label-cols-sm="7"
                                                            label-align-sm="right"
                                                    >
                                                        <b-form-input id="start"
                                                                      type="time"
                                                                      name="start"
                                                                      v-model="company.time.start"
                                                                      :value="company.time.start"
                                                                      debounce="500">
                                                        </b-form-input>
                                                    </b-form-group>
                                                <b-form-group class="col-sm-6"
                                                            label="Океончание:"
                                                            label-for="end"
                                                            label-cols-sm="7"
                                                            label-align-sm="right"
                                                    >
                                                        <b-form-input id="end"
                                                                      type="time"
                                                                      name="end"
                                                                      v-model="company.time.end"
                                                                      :value="company.time.end"
                                                                      debounce="500">
                                                        </b-form-input>
                                                    </b-form-group>
                                                <b-form-group class="col-sm-6"
                                                            label="Перерыв с:"
                                                            label-for="from"
                                                            label-cols-sm="7"
                                                            label-align-sm="right"
                                                    >
                                                        <b-form-input id="from"
                                                                      type="time"
                                                                      name="from"
                                                                      v-model="company.time.from"
                                                                      debounce="500">
                                                        </b-form-input>
                                                    </b-form-group>
                                                <b-form-group class="col-sm-6"
                                                            label="До:"
                                                            label-for="to"
                                                            label-cols-sm="7"
                                                            label-align-sm="right"
                                                    >
                                                        <b-form-input id="to"
                                                                      type="time"
                                                                      name="to"
                                                                      v-model="company.time.to"
                                                                      debounce="500">
                                                        </b-form-input>
                                                    </b-form-group>
                                            </div>
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Описание">
                                        <b-card-text>
                                            <ckeditor :editor="editor" @ready="onReady" v-model="company.text_ru" :config="editorConfig"></ckeditor>
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Лого">
                                        <b-card-text>
                                            <b-col class="product_files">
                                                <p v-if="!company.logo" class="text-danger">Нет файлов</p>
                                                <div v-else class="product_files_items">
                                                    <div class="product_files_item selected">
                                                        <img :src="company.logo" >
                                                        <b-icon-x-circle-fill
                                                                variant="danger" class="selected"
                                                                font-scale="2"
                                                                @click="removeLogo()" title="Удалить"
                                                        >
                                                        </b-icon-x-circle-fill>
                                                    </div>
                                                </div>
                                            </b-col>
                                            <b-button  variant="info" @click="info({}, 0, $event.target)"><b-icon-plus></b-icon-plus>Добавить</b-button>
                                        </b-card-text>
                                    </b-tab>
                                </b-tabs>
                            </b-tab>
                            <b-tab title="Украинский">
                                <b-tabs card>
                                    <b-tab title="Описание">
                                        <b-card-text>
                                            <ckeditor :editor="editor" @ready="onReady" v-model="company.text_uk" :config="editorConfig"></ckeditor>                                            <!--<Vueditor  v-model="text_ru"></Vueditor>-->
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
    // import axios from 'axios'
    import {mapActions, mapMutations} from 'vuex'
    import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';
    import vMediaManager from '../components/media-manager/v-media-manager'

    export default {
        name: "v-company",
        components: {vMediaManager},
        data() {
            return {
                editor: DecoupledEditor,
                editorConfig: { toolbar: {
                        items: [
                            'heading', '|',
                            'alignment', '|',
                            'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
                            'link', '|',
                            'bulletedList', 'numberedList', 'todoList',
                            'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
                            'code', 'codeBlock', '|',
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
                company: {
                    name: '',
                    logo: '',
                    phones: [],
                    socials: [],
                    time: {
                        start: '',
                        end: '',
                        from: '',
                        to: '',
                    },
                    text_ru: '',
                    text_uk: '',
                },
                infoModal: {
                    id: 'media-manager-modal',
                    title: '',
                    content: ''
                },
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
                'GET_COMPANY', 'GET_MEDIA_FOLDERS'
            ]),
            ...mapMutations([
                'SET_MEDIA_SELECTED_FILES_TO_STATE'
            ]),
            deleteSocial(index) {
                this.company.socials.splice(index, 1)
            },
            addSocial() {
                this.company.socials ? this.company.socials.push({name: '', url: '', img: ''}) : this.company.socials = [{name: '', url: '', img: ''}]
            },
            removeLogo() {
                this.company.logo = null
                this.SET_MEDIA_SELECTED_FILES_TO_STATE()
            },
            clearSelected() {
                this.SET_MEDIA_SELECTED_FILES_TO_STATE()
            },
            addSelectedFiles() {
                let selected = this.$store.state.mediaFilesSelected;
                this.company.logo = selected.length ? selected[0].img : this.company.logo;
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
                if (!this.company.text_uk) this.company.text_uk = this.company.text_ru;
                let data = this.company
                let url = this.company.id ? '/' + this.company.id : ''
                axios({
                    url: '/api/company' + url,
                    data,
                    method: this.company.id ? 'put' : 'post',
                })
                    .then((res) => {
                        this.makeToast(true, this.toastMessage(res.data.message), res.data.status);
                        if (res.data.status) {
                            this.GET_COMPANY();
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея сомпании : ', error);
                    });
            }
        },
        mounted() {
            this.GET_COMPANY().then(company =>  this.company = company ?   company : this.company)
            this.GET_MEDIA_FOLDERS('socials')
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