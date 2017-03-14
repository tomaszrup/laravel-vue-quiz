
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import router from './router/router';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('quizzes', require('./components/Quizzes'));
Vue.component('main-nav', require('./components/MainNav'))

Vue.component('staggered-fade', require('./transitions/StaggeredFade'));
Vue.component('loader', require('./components/Loader'));

window.bus = new Vue();

const app = new Vue({
    el: '#app',
    router
});
