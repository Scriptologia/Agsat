<template>
    <ul>
        <li v-for="item in list" :key="item.fullUrl">
            <span
                    @contextmenu.prevent="emitToParent({item, $event})"
                    @click="getFolders(item)"
                    class="text-info"
                    :class="{active: $store.state.activeFolder === item.fullUrl}"
            >
                <b-icon-folder2-open class="mr-1" v-if="$store.state.activeFolder === item.fullUrl"></b-icon-folder2-open>
                <b-icon-folder class="mr-1" v-else></b-icon-folder>
                {{item.name}}
            </span>
            <media-manager-folders-list :list="item.children" v-if="item.children.length" @show-content-menu="emitToParent"></media-manager-folders-list>
        </li>
    </ul>
</template>

<script>
    import {mapActions} from 'vuex'

    export default {
        name: "media-manager-folders-list",
        props: {list:Array},
        data(){
            return {
            }
        },
        methods: {
            ...mapActions([
                'GET_MEDIA_FOLDERS'
            ]),
            emitToParent(item){
                this.$emit('show-content-menu',item)
            },
            getFolders (data){
                this.GET_MEDIA_FOLDERS(data.fullUrl)
            }
        }
    }
</script>

<style lang="scss">
    .media-manager {
        &_folders ul {
            & > li > span{
                &:hover {background: aliceblue;}
                &.active { background: white;
                    border-radius: 3px;}
            }
            list-style: none;
            margin-left: 0;
            padding-left: 0;
            & li> ul {
                padding-left: 1rem;
            }
        }
        &_folders{}
        &_files{}
        &_icon:hover {
            color: green !important;
        }
    }
</style>