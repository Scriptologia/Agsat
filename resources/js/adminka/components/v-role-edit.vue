<template>
    <transition name="slide">
        <div>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <b-card bg-variant="light">
                        <validation-provider
                                name="Название"
                                :rules="{ required: true, min: 5}"
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
                                              placeholder="Пример: модератор"
                                              v-model="name"
                                              debounce="500"
                                              :state="getValidationState(validationContext)"
                                              aria-describedby="name-feedback">
                                </b-form-input>
                                <b-form-invalid-feedback id="name-feedback">{{validationContext.errors[0] }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </validation-provider>
                        <validation-provider
                                name="Slug"
                                :rules="{ required: true, min: 5,  regex: /^[a-z_]+$/ }"
                                v-slot="validationContext"
                        >
                            <b-form-group
                                    label="Slug:"
                                    label-for="slug"
                                    label-cols-sm="3"
                                    label-align-sm="right"
                            >
                                <b-form-input id="slug"
                                              name="slug"
                                              v-model="slug"
                                              placeholder="Пример: moderator или moderator_first"
                                              debounce="500"
                                              :state="getValidationState(validationContext)"
                                              aria-describedby="slug-feedback">
                                </b-form-input>
                                <b-form-invalid-feedback id="slug-feedback">{{validationContext.errors[0] }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </validation-provider>
                        <b-form-group
                                label="Права:"
                                label-for="permissions"
                                label-cols-sm="3"
                                label-align-sm="right"
                        >
                            <multiselect input-id="permissions"
                                         v-model="permissionsSelected" multiple
                                         :options="permissions"
                                         label="description" track-by="slug"
                            >
                            </multiselect>
                        </b-form-group>
                        <b-form-group
                                    label="Описание:"
                                    label-for="description"
                                    label-cols-sm="3"
                                    label-align-sm="right"
                            >
                                <b-form-input id="Описание"
                                              v-model="description"
                                              debounce="500">
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
    // import axios from 'axios'
    import {mapActions} from 'vuex'

    export default {
        name: "v-role-edit",
        props: {
            role: Object,
            permissions: Array
        },
        data() {
            return {
                spinner: true,
                id: this.role.id || null,
                slug: this.role.slug || '',
                name: this.role.name || '',
                permissionsSelected: this.role.permissions || [],
                description: this.role.description || null,
            }
        },
        methods: {
            ...mapActions([
                'GET_ROLES'
            ]),
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
                let permissions = this.permissionsSelected.map(item => item.id);
                let data = {
                    id: this.id,
                    name: this.name,
                    permissions,
                    description: this.description ? this.description : null,
                    slug: this.slug,
                };
            let url = this.id ? '/'+this.id : '';
                // axios.get('/sanctum/csrf-cookie').then(response => {
                    axios({
                        url: '/api/role' + url,
                        data,
                        method: this.id ? 'put' : 'post',
                    })
                        .then((res) => {
                            this.makeToast(true, this.toastMessage(res.data.message), res.data.status);
                            if (res.data.status) {
                                this.GET_ROLES();
                                setTimeout(() => {
                                    this.$root.$emit('bv::hide::modal', 'role-edit')
                                }, 1000)
                            }
                        })
                        .catch(function (error) {
                            console.log('Ошибка загрузки или обновлениея валюты : ', error);
                        });
                // });
            },
        },
    }
</script>

<style lang="scss">
</style>