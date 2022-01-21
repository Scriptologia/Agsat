<div class="layout_modal" ref="basket-server-modal-error" @click.self="hideModal('basket-server-modal-error')" v-cloak>
    <div class="modal_content basket-modal">
        <i class="fal fa-times" @click="hideModal('basket-server-modal-error')"></i>
        <h3>@lang('text.order-send-error')</h3>
        <br>
        <p>@lang('text.try-again-or-updait-page')</p>
        <div class="icon-center error">
            <i class="fal fa-exclamation-circle fa-3x"></i>
        </div>
    </div>
</div>