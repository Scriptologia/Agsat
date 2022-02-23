<div class="layout_modal" ref="oneclickbuymodal" @click.self="hideModal('oneclickbuymodal')" v-cloak>
    <div class="modal_content one-click-product" >
        <i class="fal fa-times" @click="hideModal('oneclickbuymodal')"></i>
        <h3>@{{ product['name_'+lang] }}</h3>
        <hr>
        <div class="one-click-product_product">
            <img :src="product.img.find(it => it.main).img">
            <div class="one-click-product_product_left">
                <div class="block-inputs">
                    <div class="form-item">
                    <label for="name">@lang('text.number'): </label>
                    <input type="number" id="name" min="1" step="1" :max="product.count" autocomplete="off" v-model.number="product.inBasket">
                </div>
                    <div class="form-item" v-if="product.service">
                        <input type="checkbox" id="service" v-model="product.isService">
                        <label for="service">@{{ product.service['name_'+lang] }} + @{{parseFloat((product.service.curs.curs * product.service.price).toFixed(0))}} грн.</label>
                    </div>
                </div>
                <h3 class="price">@{{ product.inBasket * (parseFloat((product.price * product.curs.curs * (100-product.skidka) / 100).toFixed(0)) + parseFloat((product.isService * (product.service ? product.service.curs.curs * product.service.price : 0)).toFixed(0)) )}} грн.</h3>
            </div>
        </div>
        <div class="one-click-product_form">
            <div class="form-item">
                <label for="surname">@lang('text.surname'): </label>
                <input type="text"  id="surname" autocomplete="off" v-model.trim="product.person.surname" ref="surname">
            </div>
            <div class="form-item">
                <label for="name">@lang('text.name'): </label>
                <input type="text"  id="name" autocomplete="off" v-model.trim="product.person.name" ref="name">
            </div>
            <div class="form-item">
                <label for="patronymico">@lang('text.patronymico'): </label>
                <input type="text"  id="patronymico" autocomplete="off" v-model.trim="product.person.patronymico" ref="patronymico">
            </div>
            <div class="form-item">
                <label for="phone">@lang('text.phone'): </label>
                <input type="tel"  id="phone" autocomplete="off" v-model.trim="product.person.phone" ref="phone" placeholder="+3 8(0XX) XXX-XX-XX">
            </div>
            <div class="form-item">
                <label for="region">@lang('text.region'): </label>
                <select name="region" id="region" v-model="product.person.region" ref="region">
                    <option selected disabled v-if="!regions.length" value="" >@lang('text.no-result')</option>
                    <option selected disabled v-if="regions.length" value="" >@lang('text.searched'): @{{ regions.length }}</option>
                    <option :value="post" v-for="(post, index) in regions" :key="index">@{{ post['Description'+(lang == '' || lang == 'ru' ? 'Ru' : '')] }}</option>
                </select>
            </div>
            <div class="form-item">
                <label for="city">@lang('text.city'): </label>
                <select name="city" id="city" v-model="product.person.city" ref="city">
                    <option selected disabled v-if="!cities.length" value="" >@lang('text.no-result')</option>
                    <option selected disabled v-if="cities.length" value="" >@lang('text.searched'): @{{ cities.length }}</option>
                    <option :value="post" v-for="(post, index) in cities" :key="index">@{{ post['Description'+(lang == '' || lang == 'ru' ? 'Ru' : '')] }}</option>
                </select>
            </div>
            <div class="form-item">
                <label for="post">@lang('text.new-post'): </label>
                <select name="post" id="post" v-model="product.person.post" ref="post">
                    <option selected disabled v-if="!posts.length" value="" >@lang('text.no-result')</option>
                    <option selected disabled v-if="posts.length" value="" >@lang('text.searched'): @{{ posts.length }}</option>
                    <option :value="post" v-for="(post, index) in posts" :key="index">@{{ post.DescriptionRu }}</option>
                </select>
            </div>
            <div class="errors" v-if="product.errors.length">
                <ul>
                    <li v-for="(error, index) in product.errors">@{{ error }}</li>
                </ul>
            </div>
        </div>
        <br>
        <div class="one-click-product_button">
            <button class="button-green" @click="sendOneClickToServer">@lang('text.place-order')</button>
        </div>
    </div>
</div>
