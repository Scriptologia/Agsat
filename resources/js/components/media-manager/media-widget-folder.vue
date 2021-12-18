<template>
    <div id="template-context-menu" v-click-outside="close">
        <ul id="context-menu">
            <li class="context-menu-item"  @click="info({}, 0, $event.target)">
                <img class="context-menu-icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0NS40IDQ1LjQiPjxwYXRoIGZpbGw9IiNmOTY5MGUiIGQ9Ik00MS4zIDE4LjZIMjYuOFY0YzAtMi0xLjgtNC00LTQtMi40IDAtNC4yIDItNC4yIDR2MTQuNkg0Yy0yIDAtNCAxLjgtNCA0IDAgMS4yLjUgMi4zIDEuMiAzIC44LjggMS44IDEuMyAzIDEuM2gxNC40djE0LjNjMCAxIC40IDIgMS4yIDMgLjcuNiAxLjggMSAzIDEgMi4yIDAgNC0xLjcgNC00VjI3aDE0LjVjMi4zIDAgNC0yIDQtNC4zcy0xLjgtNC00LTR6Ii8+PC9zdmc+" width="12">
                <!--<b-icon-folder-plus variant="alert"></b-icon-folder-plus>-->
                Добавить папку
            </li>
            <li class="context-menu-item" @click="remove()">
                <img class="context-menu-icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMzkuMiAzMzkuMiI+PHBhdGggZmlsbD0iI2Y5NjkwZSIgZD0iTTI0Ny4yIDE2OS42bDg0LTg0YzUuMy01LjMgOC0xMS43IDgtMTkuNCAwLTcuNi0yLjctMTQtOC0xOS40TDI5Mi40IDhDMjg3IDIuNyAyODAuNiAwIDI3MyAwYy03LjcgMC0xNCAyLjctMTkuNSA4bC04NCA4NEw4NS44IDhDODAuMyAyLjcgNzQgMCA2Ni4yIDBjLTcuNiAwLTE0IDIuNy0xOS40IDhMOCA0Ni44Yy01LjMgNS40LTggMTEuOC04IDE5LjQgMCA3LjcgMi43IDE0IDggMTkuNWw4NCA4NC04NCA4My44QzIuNyAyNTkgMCAyNjUuMyAwIDI3M2MwIDcuNiAyLjcgMTQgOCAxOS40bDM4LjggMzguOGM1LjQgNS4zIDExLjggOCAxOS40IDggNy43IDAgMTQtMi43IDE5LjUtOGw4NC04NCA4My44IDg0YzUuNCA1LjMgMTEuOCA4IDE5LjUgOCA3LjYgMCAxNC0yLjcgMTkuNC04bDM4LjgtMzguOGM1LjMtNS40IDgtMTEuOCA4LTE5LjUgMC03LjctMi43LTE0LTgtMTkuNWwtODQtODR6Ii8+PC9zdmc+" width="10">
                Удалить папку
            </li>
            <!--<li class="context-menu-item" @click="edit()">-->
                <!--<img class="context-menu-icon" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MjguOSA1MjguOSI+PHBhdGggZmlsbD0iI2Y5NjkwZSIgZD0iTTMyOSA4OWwxMDcuNSAxMDcuN0wxNjQgNDY5IDU2LjcgMzYxLjYgMzI5IDg5em0xODktMjUuOGwtNDgtNDhjLTE4LjQtMTguNS00OC41LTE4LjUtNjcgMGwtNDYgNDYgMTA3LjUgMTA3LjVMNTE4IDExNWMxNC41LTE0LjIgMTQuNS0zNy40IDAtNTEuOHpNLjQgNTEyLjdjLTIgOC44IDYgMTYuNyAxNC44IDE0LjZsMTIwLTI5TDI3LjUgMzkwLjUuMyA1MTIuNnoiLz48L3N2Zz4=" width="12">-->
                <!--Редактировать-->
            <!--</li>-->
        </ul>
        <b-modal :id="infoModal.id" :title="infoModal.title" @hide="resetInfoModal" @ok="createFolder()" @close="name=''" @cancel="name=''" ok-title="Создать" ok-variant="success">
            <template id="create-folder">
                <validation-provider
                        name="Имя"
                        :rules="{ required: true, min: 3 ,regex:'^[a-zA-Z0-9]+$'}"
                        v-slot="validationContext"
                >
                    <b-form-input
                            autofocus
                            v-model="name"
                            placeholder="Введите имя папки"
                            :state="getValidationState(validationContext)"
                            aria-describedby="name-feedback"
                    ></b-form-input>
                    <b-form-invalid-feedback id="name-feedback">{{ validationContext.errors[0]}}
                    </b-form-invalid-feedback>
                </validation-provider>
            </template>
        </b-modal>
    </div>
</template>

<script>
    import axios from 'axios'
    import {mapActions} from 'vuex'

    export default {
        name: "media-widget-folder",
        data () {
            return {
                item:{},
                name: '',
                contextShow: false,
                activeContext:false,
                contextMenuWidth: null,
                contextMenuHeight: null,
                infoModal: {
                    id: 'create-folder',
                    title: '',
                    content: ''
                }
            }
        },
        methods: {
            ...mapActions([
                'GET_MEDIA_FOLDERS'
            ]),
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            info(item, index, button) {
                 this.infoModal.title = `Новая папка в родительском каталоге "${this.item.name}"`;
                this.infoModal.content =  item
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = {}
            },
            makeToast(append = false, message, status) {
                this.$bvToast.toast(`${message}`, {
                    title: status? 'Успешно' : 'Ошибка',
                    autoHideDelay: 5000,
                    appendToast: append,
                    variant: status? 'success' : 'danger'
                })
            },
            close(){document.getElementById("context-menu").classList.remove('active')},
            contextMenu() {this.contextShow = true; this.activeContext = true},
            showContextMenu (item)  {
                this.item = {}
                let menu = document.getElementById("context-menu");
                if(!this.contextMenuWidth || !this.contextMenuHeight) {
                    menu.style.visibility = "hidden";
                    menu.style.display = "block";
                    this.contextMenuWidth = menu.offsetWidth;
                    this.contextMenuHeight = menu.offsetHeight;
                    menu.removeAttribute("style");
                }

                let med = document.getElementById("media-manager")
                let medCoord = med.getBoundingClientRect()
                let clickCoord = item.$event
                if((this.contextMenuWidth + clickCoord.pageX) >= medCoord.right) {
                    menu.style.left = medCoord.width - this.contextMenuWidth + "px";
                } else {
                    menu.style.left = clickCoord.pageX - medCoord.left + "px";
                }

                if((this.contextMenuHeight + clickCoord.pageY) >= medCoord.bottom) {
                    menu.style.top = medCoord.height - this.contextMenuHeight + "px";
                } else {
                    menu.style.top = clickCoord.pageY - medCoord.top + "px";
                }
                menu.classList.add('active');
                this.item = item.item
            },
            createFolder () {
                let url = '/api/media'
                let self = this
                let data = {directory: this.item.fullUrl + '/'+ this.name}
                axios.post(url, data, { })
                    .then((res) => {
                        this.makeToast(true, res.data.message, res.data.status);
                        if(res.data.status)  {
                            setTimeout(() => {this.GET_MEDIA_FOLDERS(self.item.fullUrl)}, 1000);
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        return error;
                    });
                this.name = ''
            },
            remove () {
                this.$bvModal.msgBoxConfirm('Вы действительно хотите удалить?', {
                    title: 'Внимание !',
                    buttonSize: 'xlg',
                    okVariant: 'danger',
                    okTitle: 'Да',
                    cancelTitle: 'Нет',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true,
                    bodyBgVariant:'warning'
                })
                    .then(value => {
                        if (value) {
                            let url = '/api/media?directory=' + this.item.fullUrl
                            let self = this
                            axios.delete(url )
                                .then((res) => {
                                    this.makeToast(true, res.data.message, res.data.status);
                                    if(res.data.status)  {
                                        setTimeout(() => {self.GET_MEDIA_FOLDERS(self.item.parent)}, 1000);
                                    }
                                })
                                .catch((error) => {
                                    console.log(error);
                                    return error;
                                });
                        }
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            edit ()  {
                alert('Edit');
            }
        }
    }
</script>

<style scoped>
    .logo {
        height: 100px;
    }

    .instructions {
        color: white;
        display: block;
        font-size: 25px;
    }

    #context-menu {
        top: 0;
        left: 0;
        margin: 0;
        padding: 0;
        display: none;
        list-style: none;
        position: absolute;
        z-index: 2147483647;
        background-color: white;
        border: 1px solid #ebebeb;
        border-bottom-width: 0;
        box-shadow: 2px 2px 19px -9px #368aa2;
    }

    #context-menu.active {
        display: block;
    }

    .context-menu-icon {
        top: 1px;
        position: relative;
        margin-right: 10px;
    }

    .context-menu-item {
        display: flex;
        cursor: pointer;
        padding: 8px 15px;
        align-items: center;
        border-bottom: 1px solid #ebebeb;
    }

    .context-menu-item:hover {
        background-color: #ebebeb;
    }
</style>