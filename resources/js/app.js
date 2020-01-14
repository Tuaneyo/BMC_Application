
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.dMoment = require('vue-moment');

import store from './store/index';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('notification', require('./components/Notification.vue').default);
Vue.component('create-post', require('./components/CreatePost.vue').default);
Vue.component('all-posts', require('./components/AllPosts.vue').default);

const moment = require('moment');
Vue.prototype.moment = moment;

const app = new Vue({
    el: '#app',
    data : {
        notifications: ''
    },
    created(){
        axios.post('/notification/get').then(response => {
            this.notifications = response.data;
        });

        var userId = $('meta[name="userId"]').attr('content');

        // Echo.private('App.User.' + userId).notification((notification) => {
        //     console.log(notification);
        // });
    }
});
