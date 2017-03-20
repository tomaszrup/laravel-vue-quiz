import './bootstrap';

Vue.component('login', require('./views/Login'));

const app = new Vue({
    el: '#app'
});
