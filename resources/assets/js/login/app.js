import './../bootstrap';

Vue.component('welcome', require('./views/Welcome'));

const app = new Vue({
    el: '#app'
});
