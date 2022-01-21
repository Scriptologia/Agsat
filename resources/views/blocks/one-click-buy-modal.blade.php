<div class="layout_modal" ref="oneclickbuymodal" @click.self="hideModal('oneclickbuymodal')" v-cloak>
    <div class="modal_content one-click-product" >
        <i class="fal fa-times" @click="hideModal('oneclickbuymodal')"></i>
        <h3>@{{ product['name_'+lang] }}</h3>
        <hr>
        <div class="one-click-product_product">
            <img :src="product.img.find(it => it.main).img">
            <div class="one-click-product_product_left">
                <div class="form-item">
                    <label for="name">@lang('text.number'): </label>
                    <input type="number" id="name" min="1" step="1" :max="product.count" autocomplete="off" v-model.number="product.inBasket">
                </div>
                <h3 class="price">@{{ product.inBasket * parseFloat((product.price * product.curs.curs * (100-product.skidka) / 100).toFixed(0)) }} грн.</h3>
            </div>
        </div>
        <div class="one-click-product_form">
            <div class="form-item">
                <label for="name">@lang('text.fio'): </label>
                <input type="text"  id="name" autocomplete="off" v-model.trim="product.person.name" ref="name">
            </div>
            <div class="form-item">
                <label for="phone">@lang('text.phone'): </label>
                <input type="tel"  id="phone" autocomplete="off" v-model.trim="product.person.phone" ref="phone" placeholder="+3 8(0XX) XXX-XX-XX">
            </div>
            <div class="form-item">
                <label for="city">@lang('text.city'): </label>
                <input type="text"  id="city" autocomplete="off" v-model.trim="product.person.city" ref="city">
            </div>
            <div class="form-item">
                <label for="street">@lang('text.street'): </label>
                <input type="text"  id="street" autocomplete="off" v-model.trim="product.person.street" ref="street">
            </div>
            <div class="form-item">
                <label for="post">@lang('text.new-post'): </label>
                <select name="post" id="post" v-model="product.person.post" ref="post">
                    <option selected disabled v-if="!product.postArr.length" value="" >@lang('text.no-result')</option>
                    <option selected disabled v-if="product.postArr.length" value="" >@lang('text.searched'): @{{ product.postArr.length }}</option>
                    <option :value="post.DescriptionRu" v-for="(post, index) in product.postArr" :key="index">@{{ post.DescriptionRu }}</option>
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
            <button class="button-green" @click="sendOneClickToServer">@lang('text.buy')</button>
        </div>
    </div>
</div>
