import VueRouter from 'vue-router';

const routes = [
  {
    path: '',
    component: require('./../views/Home.vue')
  }
];

export default new VueRouter({
  routes
});
