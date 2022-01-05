<template>
    <transition name="slide">
        <div>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <b-card bg-variant="light">
                        <validation-provider
                                name="Валюта"
                                :rules="{ required: true, min: 2 }"
                                v-slot="validationContext"
                        >
                            <b-form-group
                                    label="Валюта:"
                                    label-for="name"
                                    label-cols-sm="3"
                                    label-align-sm="right"
                            >
                                <b-form-input id="name"
                                              name="name"
                                              v-model="name"
                                              debounce="500"
                                              :state="getValidationState(validationContext)"
                                              aria-describedby="name-feedback">
                                </b-form-input>
                                <b-form-invalid-feedback id="name-feedback">{{
                                    validationContext.errors[0] }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </validation-provider>
                        <validation-provider
                                name="Slug"
                                :rules="{ required: true, min: 2 }"
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
                        <b-form-group
                                label="Курс:"
                                label-for="curs"
                                label-cols-sm="3"
                                label-align-sm="right">
                            <b-form-input id="curs"
                                          v-model.number="cur"
                                          :value="cursBase"
                                          type="number"
                                          step=".01"
                                          min="0">
                            </b-form-input>
                        </b-form-group>
                        <b-form-group
                                label="Выберите иконку:"
                                label-cols-sm="3"
                                label-align-sm="right"
                        >
                        <div class="curs_files">
                            <b-button class="mr-3" variant="info" @click="info({}, 0, $event.target)">
                                <b-icon-plus></b-icon-plus>
                                Добавить
                            </b-button>
                            <p v-if="!img">Нет файла</p>
                            <div v-else class="curs_files_item selected">
                                    <img :src="img">
                                    <b-icon-x-circle-fill
                                            variant="danger" class="selected"
                                            font-scale="2"
                                            @click="removeImg()" title="Удалить"
                                    >
                                    </b-icon-x-circle-fill>
                                </div>
                        </div>
                        </b-form-group>

                        <b-form-group
                                id="tooltip-1"
                                label=""
                                label-cols-sm="3"
                                label-align-sm="right"
                        >
                            <b-form-checkbox v-model.number="base" name="check-button" switch
                                             value="1"
                                             unchecked-value="0">Базовая
                            </b-form-checkbox>
                        </b-form-group>
                        <b-tooltip target="tooltip-1" triggers="hover">
                            В Базовой будут отображаться все цены сайта. <br>Ее курс равен 1, а курсы других валют
                            устанавливаются относительно нее
                        </b-tooltip>
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
    import {url_slug} from 'cyrillic-slug'
    import vMediaManager from '../components/media-manager/v-media-manager'

    import {mapActions, mapMutations} from 'vuex'

    export default {
        name: "v-curs-edit",
        components: {vMediaManager},
        props: {
            curs: Object,
        },
        data() {
            return {
                spinner: true,
                id: this.curs.id || null,
                slug: this.curs.slug || null,
                name: this.curs.name || null,
                img: this.curs.img || null,
                cur: this.curs.curs || 0,
                base: Object.keys(this.curs).length ? this.curs.base : 0,
                infoModal: {
                    id: 'media-manager-modal',
                    title: '',
                    content: ''
                },
                slugUrl: this.curs.id ? '/' + this.curs.slug : ''
            }
        },
        methods: {
            ...mapActions([
                'GET_CURSES'
            ]),
            ...mapMutations([
                'SET_MEDIA_SELECTED_FILES_TO_STATE'
            ]),
            addSelectedFiles() {
                let selected = this.$store.state.mediaFilesSelected;
                this.img = selected.length ? selected[0].img : this.curs.img;
                this.SET_MEDIA_SELECTED_FILES_TO_STATE()
            },
            removeImg() {
                this.img = null
                this.SET_MEDIA_SELECTED_FILES_TO_STATE()
            },
            clearSelected() {
                this.SET_MEDIA_SELECTED_FILES_TO_STATE()
            },
            itemSlug(item) {
                item.slug = item.slug || url_slug(item.value_ru)
                return item.slug;
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
                let data = {
                    'id': this.id,
                    'name': this.name,
                    'slug': this.slug,
                    'curs': this.cur,
                    'base': this.base,
                    'img': this.img
                };
                axios({
                    url: '/api/curs' + this.slugUrl,
                    data,
                    method: this.slugUrl ? 'put' : 'post',
                })
                    .then((res) => {
                        this.makeToast(true, this.toastMessage(res.data.message), res.data.status);
                        if (res.data.status) {
                            this.GET_CURSES();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'curs-edit')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея валюты : ', error);
                    });
            },
            info(item, index, button) {
                this.infoModal.title = 'Медиа менеджер';
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = {}
            },
        },
        computed: {
            slugMake: function () {
                this.slug = this.slug || url_slug(this.name)
                return this.slug;
            },
            cursBase: function () {
                this.cur = this.base === 1 ? 1 : this.cur;
                return this.cur;
            }
        }
    }
</script>

<style lang="scss">
    .curs_files {
        display: flex;
        flex-wrap: wrap;
        align-items: baseline;
        &_item {
            width: 50px;
            height: 50px;
            border: 1px solid #a0aec0;
            margin: .5rem;
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
        }
    }

    .custom-file-input:lang(ru) ~ .custom-file-label::after {
        content: 'Загрузить' !important;
    }
</style>