require('./bootstrap');

import Vue from "vue";
import store from './store'
import vueRoute from 'vue-router';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faTrash ,faEye } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import App from './component/app';
import Edit from './component/updateTodo';
import loginForm from './component/loginForm';
import registerForm from './component/registerUser';
import verify from './component/verificationCode';
import logout from './component/logout';

library.add(faPlusSquare, faTrash, faEye);

Vue.use(vueRoute);

Vue.component('font-awesome-icon', FontAwesomeIcon)

const routes = [
    {path : '/', component:App},
    {path : '/edit', component:Edit},
    {path : '/login', component:loginForm },
    {path : '/register', component:registerForm },
    {path : '/verify', component:verify },
    {path : '/logout', component:logout },
];

const router = new vueRoute({
    routes
});
const app = new Vue({
    store,
    router : router,
    components : {
        App,
        Edit,
        loginForm,
        registerForm,
        verify,
        logout
    },
    el: '#app',
});
