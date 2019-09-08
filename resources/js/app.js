/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//import routes
import {routes} from './routes'

//import user class
import User from './Helpers/User'
window.User = User

//import notification class
import Notification from './Helpers/Notification'
window.Notification = Notification

//import sweetalert2
import Swal from 'sweetalert2'
window.Swal = Swal

 
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
})
window.Toast = Toast
window.Reload = new Vue()

const router = new VueRouter({
  routes,
  mode: 'history' 
})




const app = new Vue({
	router,
    el: '#app',
});
