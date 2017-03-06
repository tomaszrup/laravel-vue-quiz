
window._ = require('lodash');

window.Vue = require('vue');

window.VueRouter = require('vue-router');

Vue.use(VueRouter);

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};
