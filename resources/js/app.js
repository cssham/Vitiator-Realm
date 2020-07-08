
require('./bootstrap');

window.Vue = require('vue');
//import and use vuex mainly import store from store folder

import store from './store/index'

//import and use vue-router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//import v-from
import { Form, HasError, AlertError } from 'vform'
window.Form = Form; //for using globally
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//import moment.js
import {filter} from './filter'
//import markdown editor
import VueMarkdownEditor from "@kangc/v-md-editor";
import "@kangc/v-md-editor/lib/style/base-editor.css";
import vuepressTheme from "@kangc/v-md-editor/lib/theme/vuepress.js";

VueMarkdownEditor.use(vuepressTheme);

Vue.use(VueMarkdownEditor);

//import & use sweetalert
import Swal from 'sweetalert2'
window.Swal =Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast =Toast;

// 1. Define route components.
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-master', require('./components/admin/MasterComponent.vue').default);

// 2. Define some routes
import {routes} from './routes';
// 3. Create the router instance and pass the `routes` option

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode:'hash'
})

// 4. Create and mount the root instance
const app = new Vue({
    el: '#app',
    router,
    store
});
