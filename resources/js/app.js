
require('./bootstrap');

window.Vue = require('vue');
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
Vue.component('nav-bar', require('./components/NavBar').default);
Vue.component('departments', require('./components/departments/Departments').default);


const app = new Vue({
    el: '#app',
});
