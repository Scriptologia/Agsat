<template>
    <transition name="slide">
        <div id="media-manager">
            <v-spinner v-if="spinner"></v-spinner>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <div class="mb-1 py-2 px-3 bg-light">
                        <b-icon-download variant="info" font-scale="2" class="mr-3 media-manager_icon" @click="dounload()"></b-icon-download>
                        <b-icon-folder-plus variant="info" font-scale="2" class="mr-3 media-manager_icon"  @click="info({}, 0, $event.target)"></b-icon-folder-plus>
                        <b-icon-trash variant="danger" font-scale="2" class="mr-3 media-manager_icon"
                                      v-if="$store.state.mediaFilesSelected.length"
                                      @click="deleteFiles()"></b-icon-trash>
                    </div>
                    <b-card class="mb-1" bg-variant="light">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" :useCustomSlot=true
                        @vdropzone-sending="filesToServer"
                        @vdropzone-success="reloadFilesFolder"
                        @vdropzone-error="errorUploadFiles"
                        >
                            <div class="dropzone-custom-content">
                                <b-icon-download scale="2" class="mb-3"></b-icon-download>
                                <h4 >Перетяните сюда файлы или нажмите здесь</h4>
                            </div>
                        </vue-dropzone>
                    </b-card>
                    <b-card class="mb-1" bg-variant="light">
                        <b-row>
                            <media-manager-folders  @show-content-folder="showContentFolder"></media-manager-folders>
                            <media-manager-files :files="files"></media-manager-files>
                        </b-row>
                    </b-card>
                </b-form>
            </validation-observer>
            <media-widget-folder ref="contentMenuFolder"></media-widget-folder>

            <b-modal :id="infoModal.id" :title="infoModal.title" @hide="resetInfoModal" @ok="createFolder()" @close="name=''" @cancel="name=''" ok-title="Создать" ok-variant="success">
                <template id="create-folder-root">
                    <validation-provider
                            name="Имя"
                            :rules="{ required: true, min: 3 ,regex:'^[a-zA-Z0-9]+$'}"
                            v-slot="validationContext"
                    >
                        <b-form-input
                                autofocus
                                v-model="name"
                                placeholder="Введите имя папки"
                                :state="getValidationState(validationContext)"
                                aria-describedby="name-feedback"
                        ></b-form-input>
                        <b-form-invalid-feedback id="name-feedback">{{ validationContext.errors[0]}}
                        </b-form-invalid-feedback>
                    </validation-provider>
                </template>
            </b-modal>
        </div>
    </transition>
</template>

<script>
    import axios from 'axios'
    import {mapActions, mapMutations} from 'vuex'
    import mediaManagerFolders from './media-manager-folders'
    import mediaManagerFiles from './media-manager-files'
    import mediaWidgetFolder from './media-widget-folder'

    export default {
        name: "v-media-manager",
        components: {mediaManagerFolders, mediaManagerFiles, mediaWidgetFolder},
        data() {
            return {
                spinner: false,
                folders:[],
                files: [],
                dropzoneOptions: {
                    url: '/api/media',
                    thumbnailWidth: 100,
                    thumbnailHeight: 100,
                    thumbnailMethod: "crop",
                    resizeWidth: 200,
                    resizeHeight: 200,
                    acceptedFiles:'image/*',
                    addRemoveLinks: true,
                    maxFilesize: 0.5,
                    headers: { "My-Awesome-Header": "header value" }
                },
                name:'',
                infoModal: {
                    id: 'create-folder-root',
                    title: '',
                    content: ''
                }
            }
        },
        methods: {
            ...mapActions([
                'GET_MEDIA_FOLDERS'
            ]),
            ...mapMutations([
                'SET_MEDIA_SELECTED_FILES_TO_STATE'
            ]),
            info(item, index, button) {
                this.infoModal.title = `Новая папка в родительском каталоге`;
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = {}
            },
            errorUploadFiles(file, message, xhr){
                this.makeToast(true, message.message, message.status);
            },
            deleteFiles() {
                let self = this
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
                    if (value) {
                        let deleteFiles = this.$store.state.mediaFilesSelected.map(item => item.realUrl)
                        let url = '/api/media/delete-files'
                        axios.post(url,  {images : deleteFiles})
                            .then((res) => {
                                this.makeToast(true, res.data.message, res.data.status);
                                if(res.data.status)  {
                                    self.SET_MEDIA_SELECTED_FILES_TO_STATE();
                                    setTimeout(() => {self.GET_MEDIA_FOLDERS(self.$store.state.activeFolder)}, 1000);
                                }
                            })
                            .catch((error) => {
                                console.log(error);
                                return error;
                            });
                    }
                })
                    .catch(err => {
                        console.log(err)
                    })
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
            // resetForm() {
            //     this.img = null;
            //     this.prev = null;
            //
            //     this.$nextTick(() => {
            //         this.$refs.observer.reset();
            //     });
            // },
            filesToServer(file, xhr, formData){
                let activeFolder = this.$store.state.activeFolder
                formData.append('directory',  typeof(activeFolder) !== "undefined" ? activeFolder: '');
            },
            reloadFilesFolder(file, response){
                console.log(file)
                console.log(response)
                this.GET_MEDIA_FOLDERS(this.$store.state.activeFolder);
            },
            createFolder(){
                let url = '/api/media'
                let data = {directory: this.name}
                axios.post(url, data, { })
                    .then((res) => {
                        this.makeToast(true, res.data.message, res.data.status);
                        if(res.data.status)  {
                            setTimeout(() => {this.GET_MEDIA_FOLDERS()}, 1000);
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        return error;
                    });
                this.name = ''
            }
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