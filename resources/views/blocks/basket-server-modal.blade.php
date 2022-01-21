<div class="layout_modal" ref="basket-server-modal" @click.self="hideModal('basket-server-modal')" v-cloak>
    <div class="modal_content basket-modal">
        <i class="fal fa-times" @click="hideModal('basket-server-modal')"></i>
        <h3>@lang('text.order-send')</h3>
        <br>
        <p>@lang('text.wait-for-call')</p>
        <div class="icon-center">
            <i class="fal fa-check-circle fa-3x"></i>
        </div>
    </div>
</div>