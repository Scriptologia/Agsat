<template>
    <transition name="slide">
        <div>
            <!--<v-spinner v-if="spinner"></v-spinner>-->
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <b-card bg-variant="light">
                                    <validation-provider
                                            name="Название"
                                            :rules="{ required: true, min: 2 }"
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
                                            name="Ширина"
                                            :rules="{ required: true, min: 2 }"
                                            v-slot="validationContext"
                                    >
                                    <b-form-group
                                                label="Ширина:"
                                                label-for="width"
                                                label-cols-sm="3"
                                                label-align-sm="right"
                                        >
                                            <b-form-input id="width"
                                                          v-model.number="width"
                                                          type="number"
                                                          debounce="500"
                                                          :state="getValidationState(validationContext)"
                                                          aria-describedby="width-feedback">
                                                >
                                            </b-form-input>
                                            <b-form-invalid-feedback id="width-feedback">{{ validationContext.errors[0]}}
                                            </b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                    <validation-provider
                                            name="Высота"
                                            :rules="{ required: true, min: 2 }"
                                            v-slot="validationContext"
                                    >
                                    <b-form-group
                                                label="Высота:"
                                                label-for="height"
                                                label-cols-sm="3"
                                                label-align-sm="right"
                                        >
                                            <b-form-input id="height"
                                                          v-model.number="height"
                                                          type="number"
                                                          debounce="500"
                                                          :state="getValidationState(validationContext)"
                                                          aria-describedby="height-feedback">
                                                >
                                            </b-form-input>
                                            <b-form-invalid-feedback id="height-feedback">{{ validationContext.errors[0]}}
                                            </b-form-invalid-feedback>
                                        </b-form-group>
                                    </validation-provider>
                                    <b-form-group
                                                label="Расширение:"
                                                label-for="resize-mime-type"
                                                label-cols-sm="3"
                                                label-align-sm="right"
                                        >
                                            <b-form-input id="resize-mime-type"
                                                          v-model="resizeMimeType"
                                                          type="text"
                                                          placeholder="пример : image/jpeg"
                                                >
                                            </b-form-input>
                                        </b-form-group>
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
    export default {
        name: "v-resize-edit",
        props: {
            resize: Object,
        },
        data() {
            return {
                spinner: true,
                id: this.resize.id || null,
                name: this.resize.name || '',
                width: this.resize.width || '',
                height: this.resize.height || '',
                resizeMimeType: this.resize.resizeMimeType || null
            }
        },
        methods: {
            ...mapActions([
                'GET_RESIZES'
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
                let url = this.id ? '/'+this.id : '';
                let  data = {'id' : this.id, 'name' : this.name, 'width' : this.width, 'height' : this.height, 'resizeMimeType' : this.resizeMimeType};
                axios({
                    url: 'http://agsat/api/resizes' + url,
                    data,
                    method: this.id ? 'put' : 'post',
                })
                    .then((res) => {
                        this.makeToast(true,  this.toastMessage(res.data.message), res.data.status);
                        if (res.data.status) {
                            this.GET_RESIZES();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'resize-edit')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея размеров : ', error);
                    });
            }
        }
    }
</script>

<style>
    .custom-file-input:lang(ru) ~ .custom-file-label::after {
        content: 'Загрузить' !important;
    }
</style>