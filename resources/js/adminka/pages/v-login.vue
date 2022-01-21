<template>
    <transition name="slide">
        <div class="v-login col-12 col-md-auto bg-light">
            <h1>Вход</h1>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                        <validation-provider
                                name="E-mail"
                                :rules="{ required: true,email }"
                                v-slot="validationContext"
                        >
                            <b-form-group
                                    label="E-mail:"
                                    label-for="email"
                                    label-cols-sm="4"
                                    label-align-sm="right"
                            >
                                <b-form-input id="email"
                                              v-model="email"
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
                                :rules="{ required: true, min:8 }"
                                v-slot="validationContext"
                        >
                            <b-form-group
                                    label="Пароль"
                                    label-for="password"
                                    label-cols-sm="4"
                                    label-align-sm="right"
                            >
                                <b-form-input id="password"
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
                        <div class="d-flex justify-content-end">
                            <b-button class="ml-2" type="submit" variant="success">Войти</b-button>
                        </div>
                </b-form>
            </validation-observer>
        </div>
    </transition>
</template>

<script>
    import store from '../vuex/store'

    export default {
        name: "v-login",
        data(){
            return {
                email:'',
                password:''
            }
        },
        methods: {
            onSubmit(){
                axios.get('/sanctum/csrf-cookie').then(response => {
                   axios.post('/login',{password: this.password, email: this.email})
                        .then(res => {
                            localStorage.setItem('x_xsrf_token',res.config.headers['X-XSRF-TOKEN'])
                            store.dispatch('GET_USER')
                            this.$router.push({name: 'home'})
                        })
                        .catch(err => {
                            this.makeToast(true, this.toastMessage(err.response.data.errors.email[0]), false);
                        })
                });
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
        }
    }
</script>

<style lang="scss">
    .v-login{
        top: 50%;
        transform: translate(-50%, -50%);
        position: absolute !important;
        left: 50%;
        padding:1rem;
        /*min-width: 400px;*/
        max-width: 400px !important;
        /*& input { width:292px}*/
    }
</style>