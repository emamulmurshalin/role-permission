require('./bootstrap');

require('alpinejs');
import Vue from "vue";

import axios from 'axios'
import VueAxios from 'vue-axios'

import Form from 'vform'
window.Form = Form;
Vue.use(VueAxios, axios);

import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';


import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);

import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)

import Swal from 'sweetalert2'
window.swal = Swal;
window.$this = Vue.use(VueToast, {
    // One of the options
    position: 'top-right',
    duration: 1000
})

import "./Admin/admin";
import "./Admin/Helpers/Helper";

import Permissions from '../js/Admin/Mixin/PermissionMixin';
Vue.mixin(Permissions);

window.Vue = require('vue').default;

const app = new Vue({
    el: "#app"
});
