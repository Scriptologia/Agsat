<template>
    <transition name="slide">
    <div>
        <v-spinner v-if="spinner"></v-spinner>
        <h1>Создать категорию</h1>
        <validation-observer ref="observer" v-slot="{ handleSubmit }">
            <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
                <b-card bg-variant="light">
                   <b-tabs pills card align="right">
                       <b-tab title="Русский" active>
                    <b-card-text>
                   <validation-provider
                                    name="Категория"
                                    :rules="{ required: true, min: 3 }"
                                    v-slot="validationContext"
                            >
                        <b-form-group
                            label="Категория:"
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
                         <b-form-invalid-feedback id="name_ru-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                        </b-form-group>
                            </validation-provider>
                    <b-form-group
                            label="Родительская категория:"
                            label-for="category_id"
                            label-cols-sm="3"
                            label-align-sm="right"
                    >
                        <b-form-select v-model="category_id"
                                       :options="categories"
                                       value-field="id"
                                       text-field="name"></b-form-select>
                    </b-form-group>
                   <validation-provider
                         name="Slug"
                         :rules="{ required: true, min: 3 }"
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
                                      debounce="500"
                                      :state="getValidationState(validationContext)"
                                      aria-describedby="slug-feedback">
                        ></b-form-input>
                        <b-form-invalid-feedback id="slug-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                    </b-form-group>
                    </validation-provider>

                     <b-form-group
                            label="Фильтры:"
                            label-for="filters"
                            label-cols-sm="3"
                            label-align-sm="right"
                    >
                        <multiselect  input-id="filters"  v-model="filtersObj" multiple :options="filterOptions"  label="name" track-by="id">
                        </multiselect>
                    </b-form-group>
                    <b-form-group
                            label="Описание:"
                            label-for="description_ru"
                            label-cols-sm="3"
                            label-align-sm="right"
                    >
                        <b-form-input id="description_ru" v-model="description_ru" debounce="500"></b-form-input>
                    </b-form-group>
                    <b-form-group
                            label="Тэги:"
                            label-for="tags_ru"
                            label-cols-sm="3"
                            label-align-sm="right"
                    >
                        <b-form-tags input-id="tags_ru" v-model="tags_ru"></b-form-tags>
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
                                drop-placeholder="Перетяните сюда..."  @change=" validate"></b-form-file>
                              <span>{{ errors[0] }}</span>
                              <b-img center :src="imgSrc" :alt="imgSrc.name" v-if="img" style="width:200px;" class="mt-3"></b-img>
                          </b-form-group>
                     </validation-provider>
                    <b-form-group
                            label="Скидка"
                            label-for="skidka"
                            label-cols-sm="3"
                            label-align-sm="right"
                    >
                        <b-form-input input-id="skidka" v-model.number="skidka" type="number" max="100" min="0"></b-form-input>
                    </b-form-group>
                    <b-form-group
                            label=""
                            label-cols-sm="3"
                            label-align-sm="right"
                    >
                        <b-form-checkbox v-model="visible" name="check-button" switch>Отображать категорию</b-form-checkbox>
                    </b-form-group>
                </b-card-text>
                </b-tab>
                       <b-tab title="Украинский">
                    <b-card-text>
                    <b-form-group
                            label="Категория:"
                            label-for=name_uk
                            label-cols-sm="3"
                            label-align-sm="right"
                    >
                        <b-form-input id="name_uk" v-model="name_uk" debounce="500" ></b-form-input>
                    </b-form-group>
                    <b-form-group
                            label="Описание:"
                            label-for="description_uk"
                            label-cols-sm="3"
                            label-align-sm="right"
                    >
                        <b-form-input id="description_uk" v-model="description_uk" debounce="500"></b-form-input>
                    </b-form-group>
                    <b-form-group
                            label="Тэги:"
                            label-for="tags_uk"
                            label-cols-sm="3"
                            label-align-sm="right"
                    >
                        <b-form-tags input-id="tags_uk" v-model="tags_uk"></b-form-tags>
                    </b-form-group>
                </b-card-text>
                </b-tab>
                   </b-tabs>
                   <b-button class="ml-2" type="submit">Сохранить</b-button>
                   <b-button class="ml-2" @click="resetForm()">Reset</b-button>
               </b-card>
            </b-form>
        </validation-observer>
    </div>
    </transition>
</template>

<script>
    export default {
        name: "v-category-create",
        beforeRouteLeave(to, from, next) {
            const answer = window.confirm('Вы хотите уйти? Вы можете потерять несохраненные данные !');
            if (answer) {next()}
            else {next(false)}
        },
        data() {
            return {
                spinner: false,
                slug: null,
                skidka: 0,
                filters: [],
                img: null,
                prev: null,
                filtersObj: [],
                category_id: null,
                name_ru: null,
                description_ru: null,
                tags_ru: [],
                name_uk: null,
                description_uk: null,
                tags_uk: [],
                visible: true,
                categories: [],
                filterOptions: []
            }
        },
         methods: {
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
                 if(this.name_uk === null) this.name_uk =  this.name_ru;
                 if(this.description_uk === null) this.description_uk =  this.description_ru;
                 if(!this.tags_uk.length) this.tags_uk =  this.tags_ru;
                 alert("Form submitted!");}
         },
        computed: {
            imgSrc: function (){console.log('ffff');
                if (this.img) {
                    var reader = new FileReader();
                    let vm = this;
                    reader.readAsDataURL(vm.img);
                    reader.onload = function(e) {
                        vm.prev = e.target.result;
                    }
                    return this.prev;
                }
            }
        },
        watch: {
            filtersObj : function () {
                this.filters = this.filtersObj.map(item => item.id)
            },
            skidka: function () {
                this.skidka = this.skidka > 100? 100 : this.skidka;
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