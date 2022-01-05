<template>
    <transition name="slide">
        <div>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                    <b-card bg-variant="light">
                        <validation-provider
                                name="Имя"
                                :rules="{ required: true, min:3 }"
                                v-slot="validationContext"
                        >
                            <b-form-group
                                    label="Имя"
                                    :label-for="name"
                                    label-cols-sm="4"
                                    label-align-sm="right"
                            >
                                <b-form-input :id="name"
                                              name="name"
                                              v-model="name"
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
                                name="E-mail"
                                :rules="{ required: true,email }"
                                v-slot="validationContext"
                        >
                            <b-form-group
                                    label="E-mail:"
                                    :label-for="email"
                                    label-cols-sm="4"
                                    label-align-sm="right"
                            >
                                <b-form-input :id="email"
                                              name="email"
                                              v-model="email"
                                              debounce="500"
                                              :state="getValidationState(validationContext)"
                                              aria-describedby="email-feedback">
                                </b-form-input>
                                <b-form-invalid-feedback id="email-feedback">
                                    {{validationContext.errors[0] }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </validation-provider>
                        <validation-provider
                                name="Пароль"
                                :rules="id ? { min:8 } : { required: true, min:8 }"
                                v-slot="validationContext"
                        >
                            <b-form-group
                                    label="Пароль"
                                    label-for="password"
                                    label-cols-sm="4"
                                    label-align-sm="right"
                            >
                                <b-form-input id="password"
                                              name="password"
                                              type="password"
                                              v-model="password"
                                              :state="getValidationState(validationContext)"
                                              aria-describedby="password-feedback">
                                </b-form-input>
                                <b-form-invalid-feedback id="password-feedback">
                                    {{validationContext.errors[0] }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </validation-provider>
                        <validation-provider
                                name="Повторить пароль"
                                v-slot="validationContext"
                                :rules="id ? { min:8} : { required: true, min:8}"
                        >
                            <b-form-group
                                    label="Повторить пароль"
                                    label-for="password_confirmation"
                                    label-cols-sm="4"
                                    label-align-sm="right"
                            >
                                <b-form-input id="password_confirmation"
                                              name="password_confirmation"
                                              type="password"
                                              v-model="password_confirmation"
                                              :state="getValidationState(validationContext)"
                                              aria-describedby="password-feedback">
                                </b-form-input>
                                <b-form-invalid-feedback id="password-feedback">
                                    {{validationContext.errors[0] }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </validation-provider>
                        <validation-provider
                                name="Роль"
                                :rules="{ required: true }"
                                v-slot="validationContext"
                        >
                            <b-form-group
                                    label="Роль"
                                    label-for="role"
                                    label-cols-sm="4"
                                    label-align-sm="right"
                            >
                                <b-form-select
                                               id="role"
                                               v-model="role_id"
                                               :options="$store.state.roles"
                                               value-field="id"
                                               text-field="name"
                                               :state="getValidationState(validationContext)"
                                               aria-describedby="role">
                                </b-form-select>
                                <b-form-invalid-feedback id="role-feedback">{{validationContext.errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                        </validation-provider>
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

    export default {
        name: "v-user-edit",
        props: {user: Object},
        data(){
            return {
                id:this.user.id || null,
                name:this.user.name || null,
                email:this.user.email || null,
                role_id:this.user.role_id || null,
                password :  null,
                password_confirmation: null
            }
        },
        methods: {
            ...mapActions([
                'GET_USERS',  'GET_ROLES'
            ]),
            onSubmit(){
                // axios.get('/sanctum/csrf-cookie').then(response => {
                    let url = this.id ? '/'+this.id : '';
                    let data =  {
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                        email: this.email,
                        id: this.id,
                        name: this.name,
                        role_id: this.role_id
                         }
                    for (let propName in data) {
                        if (data[propName] === null || data[propName] === undefined) {
                            delete data[propName];
                        }
                    }
                    axios({
                        url: '/api/user' + url,
                        data,
                        method: this.id ? 'put' : 'post',
                    })
                        .then(res => {
                            this.makeToast(true, this.toastMessage(res.data.message), res.data.status);
                            if(res.data.status) {
                                this.GET_USERS();
                                setTimeout(() => {
                                    this.$root.$emit('bv::hide::modal', 'user-edit')
                                }, 1000)}
                        })
                        .catch(err => {
                            console.log(err.response.data.message)
                            this.makeToast(true, this.toastMessage(err.response.data.message), false);
                        })
                // });
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
            }
        },
        mounted () {
            this.GET_ROLES()
        }
    }
</script>

<style>

</style>