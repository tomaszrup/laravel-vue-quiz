import VueRouter from 'vue-router';

const routes = [
  {
    path: '',
    component: require('./../views/Home')
  },
  {
    path: '/add',
    component: require('./../views/Add')
  }
];

export default new VueRouter({
  routes,
  linkActiveClass: 'is-active'
});
