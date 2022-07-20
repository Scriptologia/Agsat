window.axios = require('axios')
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
// window.axios.defaults.withCredentials = true;//необходимо для аутентификации в Sanctum-Laravel
const app = new Vue({
    el: '#app',
    data: data,
    methods: {
        makeMainImg(){
            this.$refs.mainImg.src = event.target.src
        },
        more (ref){
            this.$refs[ref].classList.toggle('max-height')
            let i = 0
            if(this.$refs[ref].classList.contains('max-height')) i = 1;
            event.target.innerHTML = this.moreShow.text[i]
        },
        sendBasketToServer(){
            this.basketPage.errors = []
            if(!this.cities.length) { this.basketPage.person.city = {};  this.basketPage.person.post = {};  }
            if(this.basketPage.person.name.length <= 2) { this.$refs['name'].classList.add('error'); this.basketPage.errors.push("поле Имя должно быть заполнено")}
            else {this.$refs['name'].classList.remove('error'); }
            if(this.basketPage.person.surname.length <= 2) { this.$refs['surname'].classList.add('error'); this.basketPage.errors.push("поле Фамилия должно быть заполнено")}
            else {this.$refs['surname'].classList.remove('error'); }
            if(this.basketPage.person.patronymico.length <= 2) { this.$refs['patronymico'].classList.add('error'); this.basketPage.errors.push("поле Отчество должно быть заполнено")}
            else {this.$refs['patronymico'].classList.remove('error'); }
            if(this.basketPage.person.phone.length < 11) { this.$refs['phone'].classList.add('error'); this.basketPage.errors.push("поле Телефон должно быть заполнено")}
            else {this.$refs['phone'].classList.remove('error'); }
            if(!Object.keys(this.basketPage.person.region).length) { this.$refs['region'].classList.add('error'); this.basketPage.errors.push("поле Область должно быть заполнено")}
            else {this.$refs['region'].classList.remove('error'); }
            if(!Object.keys(this.basketPage.person.city).length) { this.$refs['city'].classList.add('error'); this.basketPage.errors.push("поле Город должно быть заполнено")}
            else { this.$refs['city'].classList.remove('error');}
            if(!Object.keys(this.basketPage.person.post).length) { this.$refs['post'].classList.add('error'); this.basketPage.errors.push("поле Новая Почта быть заполнено")}
            else { this.$refs['post'].classList.remove('error');}

            if(!this.basketPage.errors.length) {
                let products = this.basketPage.products.map(it => {
                    let prod = {
                        id: it.id,
                        slug: it.slug,
                        name: it.name_ru,
                        category_id: it.categories[0].id,
                        category_slug: it.categories[0].slug,
                        isService: it.isService,
                        price: it.price,
                        skidka: it.skidka,
                        price_all: it.price_all,
                        price_curs: it.price_curs,
                        in_basket: it.inBasket,
                        curs:  it.curs.curs,
                        curs_name: it.curs.name,
                        img: it.img_main
                    }
                    if(it.service && it.isService){
                        prod.service = {id:it.service.id, name:it.service.name_ru, price:it.service.price, curs:it.service.curs.curs}
                        prod.price_all = prod.price_all + it.inBasket * parseFloat((it.isService * it.service.price * it.service.curs.curs).toFixed(0))
                    }
                    return prod;
                })
                let person = {
                   name:this.basketPage.person.name,
                   surname:this.basketPage.person.surname,
                   patronymico:this.basketPage.person.patronymico,
                   phone:this.basketPage.person.phone,
                   region:this.basketPage.person.region.Description,
                   city:this.basketPage.person.city.Description,
                   post:this.basketPage.person.post.Description
                }
                let data = {products, person, price:this.basketPage.price}
                axios({
                    url: this.domain+'/api/basket-from-frontend',
                    data,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    method:  'post',
                })
                    .then((res) => {
                        if (res.data.status) {
                            localStorage.clear('products')
                            this.basketPage= {
                                products:[],
                                price:0,
                                person: {city:'', region:'',post:'',phone:'', name:'', surname:'', patronymico:''}
                            }
                            this.showModal('basket-server-modal')
                        } else {
                            this.showModal('basket-server-modal-error')
                        }
                    })
                    .catch(function (error) {
                        console.log('Ошибка сохранения заказа на сервере : ', error);
                    });
            }
        },
        sendOneClickToServer() {
            this.product.errors = []
            if(!this.cities.length) { this.product.person.city = {};  this.product.person.post = {};  }
                if(this.product.person.name.length <= 2) { this.$refs['name'].classList.add('error'); this.product.errors.push("поле Имя должно быть заполнено")}
                else {this.$refs['name'].classList.remove('error'); }
                if(this.product.person.surname.length <= 2) { this.$refs['surname'].classList.add('error'); this.product.errors.push("поле Фамилия должно быть заполнено")}
                else {this.$refs['surname'].classList.remove('error'); }
                if(this.product.person.patronymico.length <= 2) { this.$refs['patronymico'].classList.add('error'); this.product.errors.push("поле Отчество должно быть заполнено")}
                else {this.$refs['patronymico'].classList.remove('error'); }
                if(this.product.person.phone.length < 11) { this.$refs['phone'].classList.add('error'); this.product.errors.push("поле Телефон должно быть заполнено")}
                else {this.$refs['phone'].classList.remove('error'); }
                if(!Object.keys(this.product.person.city).length) { this.$refs['city'].classList.add('error'); this.product.errors.push("поле Город должно быть заполнено")}
                else { this.$refs['city'].classList.remove('error');}
                if(!Object.keys(this.product.person.region).length) { this.$refs['region'].classList.add('error'); this.product.errors.push("поле Область должно быть заполнено")}
                else {this.$refs['region'].classList.remove('error'); }
                if(!Object.keys(this.product.person.post).length) { this.$refs['post'].classList.add('error'); this.product.errors.push("поле Новая Почта быть заполнено")}
                else { this.$refs['post'].classList.remove('error');}
            let it = this.product
                let prod =  {
                        id: it.id,
                        slug: it.slug,
                        name: it.name_ru,
                        category_id: it.categories[0],
                        category_slug: it.categories[0].slug,
                        isService: it.isService,
                        price: it.price,
                        skidka: it.skidka,
                        price_all: it.inBasket * parseFloat((it.price * it.curs.curs * (100-it.skidka) / 100).toFixed(0)),
                        price_curs: parseFloat((it.price * it.curs.curs * (100-it.skidka) / 100).toFixed(0)),
                        in_basket: it.inBasket,
                        curs:  it.curs.curs,
                        curs_name: it.curs.name,
                        img: it.img.find(it => it.main).img
                    }
                    if(it.service && it.isService){
                        prod.service = {id:it.service.id, name:it.service.name_ru, price:it.service.price, curs:it.service.curs.curs}
                        prod.price_all = prod.price_all + it.inBasket * parseFloat((it.isService * it.service.price * it.service.curs.curs).toFixed(0))
                    }
            let price = prod.price_all
            let person = {
                name:this.product.person.name,
                surname:this.product.person.surname,
                patronymico:this.product.person.patronymico,
                phone:this.product.person.phone,
                region:this.product.person.region.Description,
                city:this.product.person.city.Description,
                post:this.product.person.post.Description
            }
                let data = {products : [prod], person, price}
                if(!this.product.errors.length) {
                    axios({
                        url: this.domain+'/api/basket-from-frontend',
                        data,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        method:  'post',
                    })
                        .then((res) => {
                            if (res.data.status) {
                                this.hideModal('oneclickbuymodal')
                                this.showModal('basket-server-modal')
                            } else {
                                this.showModal('basket-server-modal-error')
                            }
                        })
                        .catch(function (error) {
                            console.log('Ошибка сохранения заказа на сервере : ', error);
                        });
                }
        },
        addToBasket(product) {
            let products = []
            if(localStorage.getItem('produtcs')) {
                products  = JSON.parse(localStorage.getItem('produtcs'))
                let old = products.find(it => it.id === product.id)
                if(old) {
                    if(old.count > old.inBasket) old.inBasket++;
                    if(old.count < old.inBasket) old.inBasket = old.count;
                }
                else {
                    product.inBasket = 1
                    products.push(product)
                }
            } else {
                product.inBasket = 1
                products.push(product)
            }
            localStorage.setItem('produtcs', JSON.stringify(products) )
            this.makeBasket()
            this.currentProductBasket = product
            this.showModal('basketmodal')
        },
        makeBasket (){
            if(localStorage.getItem('produtcs')) {
                let  products  = JSON.parse(localStorage.getItem('produtcs'))
                this.basket = products.reduce(function (basket, item) {
                    let serv = item.isService ? item.service.price * item.service.curs.curs : 0;
                    return {totalNumber: basket.totalNumber + item.inBasket, totalPrice: basket.totalPrice + item.inBasket*parseFloat((item.price * item.curs.curs * (100-item.skidka) / 100 + serv).toFixed(0)) }
                }, {totalNumber:0, totalPrice:0})
            } else { this.basket = {}}
        },
        axiosNovaPochta (model, data, method){
            this[model] =[]
            this.posts= []
            axios({
                url: 'https://api.novaposhta.ua/v2.0/json/'+method+'?apiKey='+this.apiKeyNovaPochta,
                data,
                headers: {
                    'Content-Type': 'application/json'
                },
                method:  'post',
            })
                .then((res) => {
                    if (res.data.success) {
                        this[model] = res.data.data
                    }
                })
                .catch(function (error) {
                    console.log('Ошибка API Новая Почта : ', error);
                });
        },
        axiosSearch(){
                axios(this.domain+'/api/search?q=' + this.search)
                    .then(res => {
                        this.searchResult = res.data.message
                    })
            clearTimeout(this.interval)
            this.interval = ''
        },
        axiosGetFiltered( paginator = this.currentPage) {
            this.currentPage = paginator
            let obj = this
            history.pushState(null, null, '/'+this.category+'/'+this.query+paginator)
            axios({
                url: '/'+this.category+'/'+this.query+paginator,
                data,
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                method:  'get'})
                .then(res => {
                    obj.filteredProducts = res.data.products
                }).catch(err => {console.log(err)})
        },
        toggleNavMenu(){
            this.$refs['nav_menu'].classList.toggle('nav_show')
        },
        hideModal(ref){
            this.$refs[ref].style.display = 'none'
            document.getElementById('app').style.position = 'relative'
        },
        showModal(ref){
            this.$refs[ref].style.display = 'block'
            document.getElementById('app').style.position = 'fixed'
        },
        showSubCategories(category){
            this.children_categories = category.children_categories.filter(item => item.visible === true)
        },
        sliderLeft(ref = 'main'){
            if(this.sliders[ref].currentSlide > 0){this.sliders[ref].currentSlide--}
        },
        sliderRight(ref = 'main'){
            if (this.sliders[ref].currentSlide >=  this.sliders[ref].img.length - 1) {
                this.sliders[ref].currentSlide = 0
            } else {
                this.sliders[ref].currentSlide++
            }
        },
        showFilterValue(e){
            this.$refs[e][0].classList.toggle("min-height")
            if(event.target.children) {
                if(event.target.children[0]) { event.target.children[0].classList.toggle("fa-rotate-180")}
                else {event.target.classList.toggle("fa-rotate-180")}
            }
        },
        showFilter(){
            this.$refs['filter'].classList.toggle("show")
        },
        selectFields(arr, filtersN){
            let filters = arr.split(';').filter(it=> it !== '')
            this.filters = filtersN.map(item => {
                if (str = filters.find(str => str.split('=')[0] === item.slug)) {
                    item.fields = item.fields.map(it => {
                        if(str.split('=')[1].split('+').find(pol => pol === it.slug)) {
                            it.selected = true ;
                        }
                        return it;
                    })
                }
                 return item;
            });
        },
        removeFromBasketPage(product, index) {
            this.basketPage.products.splice(index, 1)
            localStorage.setItem('produtcs', JSON.stringify(this.basketPage.products) )
        },
        phoneMask (v){
                var r = v.replace(/\D/g,"");
                r = r.replace(/^38+0?/,"");
            if (r.length > 6) {
                r = r.replace(/^(\d\d)(\d{2})(\d{2})(\d{0,3}).*/,"+38(0$1) $2-$3-$4");
            }
            else if (r.length > 4) {
                r = r.replace(/^(\d\d)(\d{2})(\d{0,2}).*/,"+38(0$1) $2-$3");
            }
            else if (r.length > 2) {
                r = r.replace(/^(\d\d)(\d{0,2})/,"+38(0$1) $2");
            }
            else {
                r = r.replace(/^(\d*)/, "+38(0$1");
            }
                return r;
        }
    },
    mounted(){
        this.damain = window.location.origin
        this.currentPage = window.location.search
        let arr = window.location.pathname.split('/')
        arrN = arr.filter(it => !this.arrLang.includes(it))
        this.category = arrN[0]
        if(arrN[0] && !this.noLinks.includes(arrN[0])) {
            axios(this.domain+`/api/get-filters/${arrN[0]}`)
                .then(res => {
                  filters = res.data.message;
                    if(filters.length) {
                        if(arrN.length === 2) this.query = arrN[1];
                        if(arrN[1] && arrN[1].length){
                            if(arrN[1].indexOf('=') !== -1) {
                                this.selectFields(arrN[1],filters)
                            }
                        }
                        else {
                            this.filters = res.data.message;
                        }
                    }
                })
                .catch(err => console.log(err))
        }
        if(arrN[0] === 'basket' && localStorage.getItem('produtcs')){
            this.basketPage.products = JSON.parse(localStorage.getItem('produtcs')).map(it =>
                {
                    it.price_curs = parseFloat((it.price * it.curs.curs * (100-it.skidka) / 100).toFixed(0)),
                    it.price_all = it.inBasket * parseFloat((it.price * it.curs.curs * (100-it.skidka) / 100).toFixed(0)),
                    it.img_main = it.img.find(it => it.main).img
                    return it;
                }
            )
        }

        axios(this.domain+'/api/get-categories')
            .then(res => this.categories = res.data.categories.filter(item => item.visible === true))
            .catch(err => console.log(err))
        axios(this.domain+'/api/get-sliders')
            .then(res => { this.sliders.main = {img: res.data.sliders, currentSlide: 0} ;  })
            .catch(err => console.log(err))
        if(this.sliderInterval > 0 && this.autoplaySlider) {
            setInterval(() => { this.sliderRight() },this.sliderInterval)
        }

        if(this.product) {
            let seeProducts = []
            if(localStorage.getItem('seeProdutcs')) {
                seeProducts  = JSON.parse(localStorage.getItem('seeProdutcs'))
                seeProducts.filter(it => it !== undefined)
                let old = seeProducts.find(it => it.id === this.product.id)
                if(!old) {
                    seeProducts.push(this.product)
                }
            } else {
                seeProducts.push(this.product)
            }
            localStorage.setItem('seeProdutcs', JSON.stringify(seeProducts) )
        }

        this.axiosNovaPochta('regions',
            {
                "apiKey": "",
                "modelName": "Address",
                "calledMethod": "getAreas",
                "methodProperties": {}
            }, 'AddressGeneral/getAreas',
            )

        this.makeBasket()
    },
    watch: {
        "product.person.phone": {
            handler(newQuestion, oldQuestion) {
                let self = this
                    setTimeout(function () {
                        var v = self.phoneMask(newQuestion);
                        if (v !== newQuestion) {
                            self.product.person.phone = v;
                        }
                    }, 1);
            },
            deep: true
        },
        "basketPage.person.phone": {
            handler(newQuestion, oldQuestion) {
                let self = this
                    setTimeout(function () {
                        var v = self.phoneMask(newQuestion);
                        if (v !== newQuestion) {
                            self.basketPage.person.phone = v;
                        }
                    }, 1);
            },
            deep: true
        },
        "basketPage.products": {
            handler(newQuestion, oldQuestion) {
                if(newQuestion) {
                    this.basketPage.price = newQuestion.reduce(function (price, it) {
                        let serv = it.isService ? it.service.price * it.service.curs.curs : 0;
                        return price + it.inBasket * (it.price_curs + serv);
                    },0)
                    this.basketPage.products.map(it => {
                        let serv = 0
                        if(it.service && it.isService){
                            serv = it.service.price * it.service.curs.curs;
                        }
                        it.price_all = it.inBasket * parseFloat((it.price * it.curs.curs * (100-it.skidka) / 100 + serv).toFixed(0))
                        return it;
                    })
                    localStorage.setItem('produtcs', JSON.stringify(this.basketPage.products) )
                    this.makeBasket()
                }
            },
            deep: true
        },
        'product.person.region': {
            handler(newQuestion, oldQuestion) {
                this.axiosNovaPochta('cities',
                    {
                        "modelName": "Address",
                        "calledMethod": "getCities",
                        "methodProperties": {
                            "AreaRef": newQuestion.Ref,
                            "Warehouse": "1",
                        },
                    }, 'Address/newQuestion'
                )
            },
            deep: true
        },
        'product.person.city': {
            handler(newQuestion, oldQuestion) {
                this.axiosNovaPochta('posts',
                    {
                        "modelName": "Address",
                        "calledMethod": "getWarehouses",
                        "methodProperties": {
                            "CityName": newQuestion.DescriptionRu,
                            "Warehouse": "1",
                        },
                    }, 'Address/getWarehouses'
                )
            },
            deep: true
        },
        'basketPage.person.region': {
            handler(newQuestion, oldQuestion) {
                this.axiosNovaPochta('cities',
                    {
                        "modelName": "Address",
                        "calledMethod": "getCities",
                        "methodProperties": {
                            "AreaRef": newQuestion.Ref,
                            "Warehouse": "1",
                        },
                    }, 'Address/newQuestion'
                )
            },
            deep: true
        },
        'basketPage.person.city': {
            handler(newQuestion, oldQuestion) {
                this.axiosNovaPochta('posts',
                    {
                        "modelName": "Address",
                        "calledMethod": "getWarehouses",
                        "methodProperties": {
                            "CityName": newQuestion.DescriptionRu,
                            "Warehouse": "1",
                        },
                    }, 'Address/getWarehouses'
                )
            },
            deep: true
        },
        search: function (newQuestion, oldQuestion) {
            if(!newQuestion.length) this.searchResult = {};
            if(newQuestion.length >= 4) {
                if(this.interval) {return null;}
                this.interval = setTimeout(() => {this.axiosSearch()}, 1000)
            }
        },
        filters : {
            handler(newFilters, oldFilters) {
                if(oldFilters.length) {
                    let query = '';
                    newFilters.forEach(function (item, index, arr) {
                        let selected =  item.fields.filter(it => it.selected).map(it => it.slug)
                        if(selected.length) query += item.slug + '=' + selected.join('+')+';';
                    })
                    this.query = query.slice(0, -1)
                    this.axiosGetFiltered(paginator = "")
                }
            },
            deep: true
        }
    },
    computed: {
        numFilterSelected() {
            return this.filters.reduce(function (sumAll, item) {
               return sumAll + item.fields.reduce(function (sum, it) {
                   if( it.selected) sum++
                    return sum;
                }, 0)
            }, 0)
        },
        seeProducts(){
            let seeProducts = []
            if(localStorage.getItem('seeProdutcs')) {
                seeProducts  = JSON.parse(localStorage.getItem('seeProdutcs'))
            }
            return seeProducts;
        }
    }
 })