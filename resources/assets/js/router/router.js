import VueRouter from 'vue-router';

const routes = [
  {
    path: '',
    component: require('./../views/Home')
  },
  {
    path: '/add',
    component: require('./../views/Add')
  },
  {
    path: '/quiz/:quiz',
    component: require('./../views/Quiz'),
    name: 'quiz'
  },
  {
    path: '*',
    component: require('./../views/NotFound')
  }
];

export default new VueRouter({
  routes,
  linkActiveClass: 'is-active',
  mode: 'history'
});
