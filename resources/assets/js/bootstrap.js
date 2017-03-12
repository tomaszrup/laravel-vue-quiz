import Vue from 'vue';
import VueRouter from 'vue-router';
//import Vuex from 'vuex';
import axios from 'axios';
import lodash from 'lodash';

//import moment from 'moment';
//import 'moment/locale/pl';


window.Vue = Vue;
//window.Vuex = Vuex;
Vue.use(VueRouter);
//Vue.use(Vuex);

window.axios = axios;
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

window._ = lodash;

//window.moment = moment;
//moment.locale('pl');
