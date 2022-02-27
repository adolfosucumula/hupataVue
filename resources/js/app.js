/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueSweetalert2 from 'vue-sweetalert2';
import VueTheMask from 'vue-the-mask';
import Notifications from 'vue-notification';

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import Home from './components/website/Home.vue';
import FormWebContact from './components/website/Form.vue';
import ListWebContact from './components/website/Lists.vue';
import EditWebContactForm from './components/website/EditForm.vue';
import WebSignIn from './components/website/SignIn.vue';
import WebSignUp from './components/website/SignUp.vue';

Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(VueTheMask);
Vue.use(Notifications);

const routes = [
    { path: '/', component: Home   },
    { path: '/webcontact/form', component: FormWebContact   },
    { path: '/webcontact/list', component: ListWebContact   },
    { path: '/webcontact/form/edit', component: EditWebContactForm   },
    { path: '/webcontact/signin', component: WebSignIn   },
    { path: '/webcontact/signup', component: WebSignUp   },
];

const colorsOption = {
    confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674',
};

Vue.use(VueSweetalert2, colorsOption);

const router = new VueRouter({routes});

const app = new Vue({
    el: '#app',
    router,
});
