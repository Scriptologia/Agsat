<template>
    <transition name="slide">
        <div id="media-manager">
            <v-spinner v-if="spinner"></v-spinner>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <div class="mb-1 py-2 px-3 bg-light">
                        <b-icon-download variant="info" font-scale="2" class="mr-3 media-manager_icon" @click="dounload()"></b-icon-download>
                        <b-icon-folder-plus variant="info" font-scale="2" class="mr-3 media-manager_icon" @click="createFolder()"></b-icon-folder-plus>
                    </div>
                    <b-card class="mb-1" bg-variant="light"></b-card>
                    <b-card class="mb-1" bg-variant="light">
                        <b-row>
                            <media-manager-folders  @show-content-folder="showContentFolder"></media-manager-folders>
                            <media-manager-files :files="files"></media-manager-files>
                        </b-row>
                    </b-card>
                    <div class="d-flex justify-content-end">
                        <!--<b-button class="ml-2" type="submit" variant="success" @click="addFiles">Сохранить</b-button>-->
                    </div>
                </b-form>
            </validation-observer>
            <media-widget-folder ref="contentMenuFolder"></media-widget-folder>
        </div>
    </transition>
</template>

<script>
    import axios from 'axios'
    import {mapActions} from 'vuex'
    import mediaManagerFolders from './media-manager-folders'
    import mediaManagerFiles from './media-manager-files'
    import mediaWidgetFolder from './media-widget-folder'

    export default {
        name: "v-media-manager",
        components: {mediaManagerFolders, mediaManagerFiles, mediaWidgetFolder},
        data() {
            return {
                folders:[],
                files: [],
                spinner: false,
                slugUrl: ''//this.category.id ? '/' + this.category.slug : ''
            }
        },
        methods: {
            ...mapActions([
                'GET_MEDIA_FOLDERS'
            ]),
            addFiles(files) {
            },
            showContentFolder(data){
                this.$refs.contentMenuFolder.showContextMenu(data)
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
                                this.$root.$emit('bv::hide::modal', 'media-manager')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея : ', error);
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
            }
        },
        watch: {
        },
        mounted() {
            this.GET_MEDIA_FOLDERS();
        }
    }
</script>

<style lang="scss">
        .custom-file-input:lang(ru) ~ .custom-file-label::after {
            content: 'Загрузить' !important;
        }
</style>