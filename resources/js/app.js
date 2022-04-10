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
import Money from 'v-money';
import Notifications from 'vue-notification';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import Home from './components/website/Home.vue';
import FormWebContact from './components/website/Form.vue';
import ListWebContact from './components/website/Lists.vue';
import EditWebContactForm from './components/website/EditForm.vue';
import WebSignIn from './components/website/SignIn.vue';
import WebSignUp from './components/website/SignUp.vue';
import DashboardUser from './components/website/DashboardUser.vue';
import Logout from './components/website/Logout.vue';
import RecentJobs from './components/website/RecentJobs.vue';
import SavedJobs from './components/website/SavedJobs.vue';
import Jobs from './components/website/Jobs.vue';
import JobDetails from './components/website/JobDetails.vue';
import PostJobsForm from './components/website/PostJobsForm.vue';
import PostedJobs from './components/website/PostedJobs.vue';


Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(VueTheMask);
Vue.use(Money, {precision: 4});
Vue.use(Notifications);
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

const routes = [
    { path: '/', component: Home   },
    { path: '/webcontact/form', component: FormWebContact   },
    { path: '/webcontact/list', component: ListWebContact   },
    { path: '/webcontact/form/edit', component: EditWebContactForm   },
    { path: '/webcontact/signin', component: WebSignIn   },
    { path: '/webcontact/signup', component: WebSignUp   },
    { path: '/web/dashboard', component: DashboardUser   },
    { path: '/web/user/logout', component: Logout   },
    { path: '/web/dashboard/jobs', component: Jobs  },
    { path: '/web/dashboard/job/:title/:id', component: JobDetails  },
    { path: '/web/dashboard/job/post', component: PostJobsForm  },
    { path: '/web/dashboard/recent-jobs', component: RecentJobs   },
    { path: '/web/dashboard/saved-jobs', component: SavedJobs   },
    { path: '/web/dashboard/posted-jobs', component: PostedJobs }

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



/*   Navigation Effetc */
/*const list = document.querySelectorAll('.list');
function activeLink(){
    list.forEach((item) =>
    item.classList.remove('active'));
    this.classList.add('active');
}
list.forEach((item) =>
item.addEventListener('click', activeLink ));*/
