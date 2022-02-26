
require('./bootstrap');

window.Vue = require('vue');
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
Vue.component('nav-bar', require('./components/NavBar').default);
Vue.component('departments', require('./components/departments/Departments').default);
Vue.component('category', require('./components/categories/Categories').default);
Vue.component('users', require('./components/users/Users').default);

const app = new Vue({
    el: '#app',
});
