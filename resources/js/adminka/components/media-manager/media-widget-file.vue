<template>
    <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
        <div v-if="showContextMenu" class="context-menu" v-bind:style="contextMenuStyle">
            <ul v-if="contextMenuFile.type=='dir'">
                <li><a v-on:click.prevent="onMediaClick(contextMenuFile)" href="#"><i class="fa fa-fw fa-folder-open"></i> Open</a></li>
                <li><a v-on:click.prevent="mmc.toggleDetailsOn(contextMenuFile)" href="#"><i class="fa fa-fw fa-info-circle"></i> Details</a></li>
            </ul>
            <ul v-else>
                <li v-if="mmc.isSelected(contextMenuFile)"><a v-on:click.prevent="mmc.unselectFile(contextMenuFile)" href="#"><i class="fa fa-fw fa-times"></i> Unselect</a></li>
                <li v-else><a v-on:click.prevent="mmc.selectFile(contextMenuFile)" href="#"><i class="fa fa-fw fa-check"></i> Select</a></li>
                <li><a v-on:click.prevent="mmc.toggleDetailsOn(contextMenuFile)" href="#"><i class="fa fa-fw fa-info-circle"></i> Details</a></li>
                <li><a v-bind:href="$api.downloadUrl(contextMenuFile)"><i class="fa fa-fw fa-download"></i> Download</a></li>
            </ul>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "media-widget-file",
        data() {
            return {
                files: [],
                loading: false,
                error: false,
                contextMenuFile: {},
                contextMenuX: 0,
                contextMenuY: 0,
                showContextMenu: false
            };
        },
        props: [ 'path' ],
        computed: {
            ...mapState({
                basePath: state => state.options.basePath
            }),
            mmc() {
                return this.$root.$mmc;
            },
            relPath() {
                return this.path.replace(this.basePath, '');
            },
            pathUp() {
                let path = '', index = this.relPath.lastIndexOf('/');
                if (index>-1) {
                    path = this.relPath.slice(0, index);
                }
                return this.basePath + path;
            },
            contextMenuStyle() {
                return 'left: '+this.contextMenuX+'px; top:'+this.contextMenuY+'px;';
            }
        },
        watch: {
            path: function() {
                this.refresh();
            }
        },
        mounted() {
            this.refresh();
        },
        methods: {
            refresh() {
                this.loading = true;
                this.error = false;

                this.$api.list(this.path)
                    .then(response => {
                        if (Array.isArray(response.data)) {
                            response.data.sort((a, b) => {
                                let as = a.type +'/'+ a.basename,
                                    bs = b.type +'/'+ b.basename;
                                return as.localeCompare(bs)
                            });
                            this.files = response.data;
                        }
                        this.loading = false;
                    }, error => {
                        // TODO
                        this.error = error.toString();
                        this.files = [];
                        this.loading = false;
                    });
            },
            browse(path) {
                this.mmc.path = path;
            },

            onMediaClick(file) {
                if (file.type=='dir') {
                    this.browse(file.path);
                } else {
                    let mmc = this.mmc;
                    if (mmc.isSelected(file)) {
                        mmc.unselectFile(file);
                    } else {
                        mmc.selectFile(file);
                    }
                }
            },

            onDocumentClick(e) {
                this.toggleContextMenuOff();
            },
            onContextMenu(file, e) {
                let clientRect = this.mmc.$el.getBoundingClientRect();
                this.contextMenuFile = file;
                this.contextMenuX = e.clientX - clientRect.left;
                this.contextMenuY = e.clientY - clientRect.top;
                this.toggleContextMenuOn();
            },
            toggleContextMenuOn() {
                this.showContextMenu = true;
                document.addEventListener('click', this.onDocumentClick);
            },
            toggleContextMenuOff() {
                this.contextMenuFile = {};
                this.contextMenuX = 0;
                this.contextMenuY = 0;
                this.showContextMenu = false;
                document.removeEventListener('click', this.onDocumentClick);
            }
        }
    };
</script>

<style scoped>

</style>