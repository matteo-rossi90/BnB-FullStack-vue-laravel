import { createRouter, createWebHistory } from "vue-router";

import Home from '../pages/Home.vue'
import Login from '../pages/Login.vue'
import Register from '../pages/Register.vue'
import Dashboard from '../pages/Ura/Dashboard.vue'
import CreateApartment from '../pages/Ura/CreateApartment.vue'
import IndexApartment from "../pages/Ura/IndexApartment.vue";

const router = createRouter({
    history: createWebHistory(),
    routes:
    [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/registrati',
            name: 'register',
            component: Register
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/appartamenti',
            name: 'apartments',
            component: IndexApartment
        },
        {
            path: '/nuovo-appartamento',
            name: 'createApartment',
            component: CreateApartment
        },


    ]
})

export default router;
