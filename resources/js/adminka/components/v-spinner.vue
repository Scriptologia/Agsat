<template>
    <div class="spinner">
        <b-spinner variant="primary" label="Loading..." class="spinner" v-if="this.$store.state.spinner"></b-spinner>
    </div>
</template>

<script>
    export default {
        name: "v-spinner",
    }
</script>

<style >
    .spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        /*transform: translate(50%, 50%);*/
        z-index: 100;
    }
</style>