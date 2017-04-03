import Vue from 'vue';
import lodash from 'lodash';
import * as vueSmoothScroll from 'vue-smoothscroll';
import axios from 'axios';


window.Vue = Vue;
Vue.use(vueSmoothScroll);

window._ = lodash;

window.axios = axios;
