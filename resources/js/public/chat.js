
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
import Echo from "laravel-echo"

// const client = require('socket.io-client');
window.Pusher = require('pusher-js');
// window.io = require('socket.io-client');

// if (typeof io !== 'undefined') {
//     window.Echo = new Echo({
//         broadcaster: 'socket.io',
//         // host: 'http://127.0.0.1:6001',
//         host: window.location.hostname + ':6001',
//         // transports: ['websocket']
//         // transports: [ 'polling']
//     });
//     console.log('Connected to socket.io');
// } else {
//     console.log('Not connected to socket.io');
// }
if (typeof Pusher !== 'undefined') {
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY  ,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER  ,
        wsHost: window.location.hostname,
        wsPort:  6001,
    });
    console.log('Connected to pusher');
} else {
    console.log('Not connected to pusher');
}
window.Vue = require('vue').default;

const app = new Vue({
    el: '#app',
    data() {
        return {
            auth : data,
            user: null,
            messages:[],
            text:'',
            isActive: false,
            typingTimer: false,
            activeUsers: [],
        }
    },
    methods: {
        send (){
            if(this.text !== '') {
                axios.post('api/chat', {body: this.text, client_1 : this.auth.id, client_2 : this.user.id})
                this.messages.push(this.text)
                this.text = ''
            }
        },
        actionUser (){
            this.channel
                .whisper('typing', {
                    name: this.auth.name
                })
        }
    },
    computed: {
        channel () {
            let chat
            if(this.auth.id > this.user.id ) {chat = this.user.id + '.' + this.auth.id}
            else{chat = this.auth.id + '.' + this.user.id}
            return  window.Echo.join('chat.' + chat)
        }
    },
    mounted(){
        // axios.get('api/chat')
        //     .then(function (response) {
        //         // console.log(response.data)
        //         self.messages = response.data
        //     })
        //     .catch(function (error) {
        //         console.log(error);
        //     })

        this.channel
            .here((users) => { this.activeUsers = users })
            .joining((user) => { this.activeUsers.push(user)})
            .leaving((user) => { this.activeUsers.splice(this.activeUsers.indexOf(user), 1)})
            .listen('PrivateChat', ({data}) => {
                this.messages.push(data.body)
                this.isactive = false
            })
            .listenForWhisper('typing', (e) =>  {
                this.isActive = e
                if(this.typingTimer) clearTimeout(this.typingTimer);
                this.typingTimer = setTimeout(() => { this.isActive = false }, 2000)
            })
    }

});