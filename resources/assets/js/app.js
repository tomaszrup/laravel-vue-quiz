import './bootstrap';
import router from './router/router';

Vue.component('quizzes', require('./components/Quizzes'));
Vue.component('main-nav', require('./components/MainNav'))

Vue.component('staggered-fade', require('./transitions/StaggeredFade'));
Vue.component('loader', require('./components/Loader'));

Vue.component('welcome', require('./views/Welcome'));

window.bus = new Vue();

const app = new Vue({
    el: '#app',
    router,
    data() {
      return {
        user: false
      }
    },
    created() {
      axios.get('/api/user').then((response) => {
        this.user = response.data.data;
      })
    }
});
