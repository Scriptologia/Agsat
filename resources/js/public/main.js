window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.withCredentials = true;//необходимо для аутентификации в Sanctum-Laravel

const app = new Vue({
    el: '#app',
    data: data,
    methods: {
        axiosSearch(){
            console.log(this.search)
        },
        hideNavMenu(){
            this.$refs['nav_menu'].classList.remove('nav_show')
        },
        showNavMenu(){
            this.$refs['nav_menu'].classList.add('nav_show')
        },
        hideContacts(){
            this.$refs['contacts'].style.display = 'none'
        },
        showContacts(){
            this.$refs['contacts'].style.display = 'block'
        },
        showSubCategories(category){
            this.children_categories = category.children_categories.filter(item => item.visible === true)
        },
        sliderLeft(){
            if(this.currentSlide > 0){this.currentSlide--}
        },
        sliderRight(){
            if (this.currentSlide >= this.sliders.length - 1) {
                this.currentSlide = 0
            } else {
                this.currentSlide++
            }
        }
    },
    mounted(){
        axios('/api/get-categories')
            .then(res => this.categories = res.data.categories.filter(item => item.visible === true))
            .catch(err => console.log(err))
        axios('/api/get-sliders')
            .then(res => this.sliders = res.data.sliders)
            .catch(err => console.log(err))
        let vm = this
        if(this.sliderInterval > 0) {
            setInterval(function(){
                vm.sliderRight()
            },vm.sliderInterval)
        }
    },
    watch: {
        search: function (newQuestion, oldQuestion) {
            if(newQuestion.length >= 4) {
                axios('/api/search')
                    .then(res => {
                        console.log(res.data)
                        this.searchResult = res.data
                    })
            }
        }
    }
 })