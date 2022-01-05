<template>
    <div  bg-variant="light" class="media-manager_folders">
         <media-manager-folders-list :list="$store.state.mediaFolders" v-if="$store.state.mediaFolders.length" @show-content-menu="showContentMenu"></media-manager-folders-list>
        <p v-else>Нет папок</p>
    </div>
</template>

<script>
    import mediaManagerFoldersList from './media-manager-folders-list'

    export default {
        name: "media-manager-folders",
        components: {mediaManagerFoldersList},
        data(){
            return {
                files: [],
            }
        },
        methods: {
            showContentMenu(item) {
                this.$emit('show-content-folder',item)
            }
        }
    }
</script>

<style lang="scss">
</style>