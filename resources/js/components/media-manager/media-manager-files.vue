<template>
    <b-col sm="8" class="media-manager_files">
        <p v-if="!$store.state.mediaFiles.length">Нет файлов</p>
        <div v-else class="media-manager_files_items">
            <div v-for="(img, index) in files"
                 :key="index"
                 class="media-manager_files_item" :class="{selected :  img.selected}"
                 @click="addSelected(img)"
            >
                <img :src="img.img" >
                <b-icon-check variant="success" class="selected" font-scale="2" animation="pulse" v-if="img.selected"></b-icon-check>
            </div>
        </div>
    </b-col>
</template>

<script>
    import {mapMutations} from 'vuex'
    export default {
        name: "media-manager-files",
        data(){
            return {
                selected: [],
            }
        },
        methods: {
            ...mapMutations([
                'SET_MEDIA_SELECTED_FILES_TO_STATE'
            ]),
            addSelected(img){
                let inArr = this.selected.find(item => item.img === img.img)
                if (inArr) {
                    this.selected = this.selected.filter(item => item.img !== img.img)
                }
                else {
                        img.selected = true
                    this.selected.push(img)
                    }
                this.SET_MEDIA_SELECTED_FILES_TO_STATE(this.selected)
            },
        },
        computed: {
            files: function () {
                let self = this
                return this.$store.state.mediaFiles.map(function (it) {
                    it.selected = false
                    if(self.selected.length){
                        if(self.selected.find(item => item.img === it.img)) it.selected = true ;
                    }
                    return it ;
                })
            }
        }
    }
</script>

<style lang="scss">
    .media-manager_files {
        &_items {display: flex;}
        &_item {
            width:100px;height:100px;
            border: 1px solid #a0aec0;margin:.5rem;
            position: relative;
            box-shadow: 0 0 8px 0 #627f83;
            &.selected:before {
                content: "";
                position: absolute;
                right: -1px;
                top: -1px;
                border: 20px solid transparent;
                border-top: 20px solid #f8f9fa;
                border-right: 20px solid white;
            }
            & img {
                object-fit: cover;
                width: 100%;
                height: 100%;
            }
            & .selected {
                position: absolute;
                right: -3px;
                top: -3px;
            }
        }
    }
</style>