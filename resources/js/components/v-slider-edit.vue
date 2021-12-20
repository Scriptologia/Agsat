<template>
    <transition name="slide">
        <div>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <b-card bg-variant="light">
                            <b-form-group
                                    label="Текст:"
                                    label-for="text"
                                    label-cols-sm="3"
                                    label-align-sm="right"
                            >
                                <b-form-input id="text"
                                              type="text"
                                              name="text"
                                              v-model="text"
                                              debounce="500">
                                </b-form-input>
                            </b-form-group>
                            <b-form-group
                                    label="Ссылка:"
                                    label-for="url"
                                    label-cols-sm="3"
                                    label-align-sm="right"
                            >
                                <b-form-input id="url"
                                              v-model="url"
                                    >
                                </b-form-input>
                            </b-form-group>

                        <b-form-group
                                label="Выберите изображение:"
                                label-cols-sm="3"
                                label-align-sm="right"
                        >
                        <div class="curs_files">
                            <b-button class="mr-3" variant="info" @click="info({}, 0, $event.target)">
                                <b-icon-plus></b-icon-plus>
                                Добавить
                            </b-button>
                            <p v-if="!img" class="text-danger">Нет файла !</p>
                            <div v-else class="curs_files_item-slider selected">
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
    import axios from 'axios'
    import vMediaManager from '../components/media-manager/v-media-manager'

    import {mapActions, mapMutations} from 'vuex'

    export default {
        name: "v-slider-edit",
        components: {vMediaManager},
        props: {
            slider: Object,
        },
        data() {
            return {
                spinner: true,
                id: this.slider.id || null,
                url: this.slider.url || null,
                img: this.slider.img || null,
                text: this.slider.text || null,
                infoModal: {
                    id: 'media-manager-modal',
                    title: '',
                    content: ''
                }
            }
        },
        methods: {
            ...mapActions([
                'GET_SLIDERS'
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
                if(this.img === null) return ;
                let data = {
                    'id': this.id,
                    'text': this.text,
                    'url': this.url,
                    'img': this.img
                };
                let url = this.id !== null? '/' + this.id : ''
                axios({
                    url: 'http://agsat/api/sliders' + url ,
                    data,
                    method: this.id ? 'put' : 'post',
                })
                    .then((res) => {
                        this.makeToast(true, this.toastMessage(res.data.message), res.data.status);
                        if (res.data.status) {
                            this.GET_SLIDERS();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'slider-edit')
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
        }
    }
</script>

<style lang="scss">
    .curs_files {
        display: flex;
        flex-wrap: wrap;
        align-items: baseline;
        &_item-slider {
            width: auto;
            height: 100px;
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