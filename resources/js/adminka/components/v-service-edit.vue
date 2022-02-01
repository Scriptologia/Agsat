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
                                                    услугу
                                                </b-form-checkbox>
                                            </b-form-group>
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Описание">
                                        <b-card-text>
                                            <ckeditor :editor="editor" @ready="onReady" v-model="text_ru" :config="editorConfig"></ckeditor>
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
                                        </b-card-text>
                                    </b-tab>
                                    <b-tab title="Описание">
                                        <b-card-text>
                                            <ckeditor :editor="editor" @ready="onReady" v-model="text_uk" :config="editorConfig"></ckeditor>                                            <!--<Vueditor  v-model="text_ru"></Vueditor>-->
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
    import {mapActions} from 'vuex'
    import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';
    export default {
        name: "v-service-edit",
        props: {
            service: Object, curses: Array,
        },
        data() {
            return {
                editor: DecoupledEditor,
                editorConfig: {
                    toolbar: {
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
                id: this.service.id || null,
                name_ru: this.service.name_ru,
                text_ru: this.service.text_ru,
                name_uk: this.service.name_uk,
                text_uk: this.service.text_uk,
                curs_id: this.service.curs_id || this.curses.find(it => it.base).id,
                price: this.service.price || 0,
                visible: Object.keys(this.service).length ? this.service.visible : true,
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
                'GET_SERVICES'
            ]),
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
                if (!this.name_uk) this.name_uk = this.name_ru;
                if (!this.text_uk) this.text_uk = this.text_ru;
                let data = {
                    name_ru: this.name_ru,
                    text_ru: this.text_ru,
                    name_uk: this.name_uk,
                    text_uk: this.text_uk,
                    price: this.price,
                    curs_id: this.curs_id,
                    visible: this.visible,
                }
                let url = this.id ? '/'+this.id : '';
                axios({
                    url: '/api/service' + url,
                    data,
                    method: this.id ? 'put' : 'post',
                })
                    .then((res) => {
                        this.makeToast(true, this.toastMessage(res.data.message), res.data.status);
                        if (res.data.status) {
                            this.GET_SERVICES();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'service-edit')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея услуги : ', error);
                    });
            }
        },
        watch: {
            price: function () {
                let  arr = this.price.toString().split( '.' )
                this.price = arr.length == 2 && arr[1].length > 2? this.$options.filters.floatNumber(this.price, 2) : this.price
            },
        },
    }
</script>

<style lang="scss">
    .ck {
        &-content {
            background: white;
        }
    }
</style>