<template>
    <transition name="slide">
        <div>
            <!--<v-spinner v-if="spinner"></v-spinner>-->
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
                                            <b-img center :src="imgSrc" :alt="imgSrc.name" v-if="img"
                                                   style="width:200px;" class="mt-3"></b-img>
                                        </b-form-group>
                                    </validation-provider>
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
                           В Базовой будут отображаться все цены сайта. <br>Ее курс равен 1, а курсы других валют устанавливаются относительно нее
                        </b-tooltip>
                        <div class="d-flex justify-content-end">
                            <!--<b-button class="ml-2" @click="resetForm()">Reset</b-button>-->
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
    import { url_slug } from 'cyrillic-slug'

    import {mapActions} from 'vuex'
    export default {
        name: "v-curs-edit",
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
                slugUrl: this.curs.id ? '/' + this.curs.slug : ''
            }
        },
        methods: {
            ...mapActions([
                'GET_CURSES'
            ]),
            itemSlug (item) {
                item.slug = item.slug || url_slug(item.value_ru)
                return item.slug;
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
            onSubmit() {
                let  data = {'id' : this.id, 'name' : this.name, 'slug' : this.slug, 'curs' : this.cur, 'base' : this.base, 'img' : this.img};
                axios({
                    url: 'http://agsat/api/curs' + this.slugUrl,
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
                            this.GET_CURSES();
                            setTimeout(() => {
                                this.$root.$emit('bv::hide::modal', 'curs-edit')
                            }, 1000)
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка загрузки или обновлениея валюты : ', error);
                    });
            }
        },
        computed: {
            slugMake: function () {
                this.slug = this.slug || url_slug(this.name)
                return this.slug;
            },
            cursBase: function () {
                this.cur =  this.base === 1? 1 : this.cur;
                return this.cur ;
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
    .custom-file-input:lang(ru) ~ .custom-file-label::after {
        content: 'Загрузить' !important;
    }
</style>