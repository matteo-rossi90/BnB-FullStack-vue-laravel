import { createRouter, createWebHistory } from "vue-router";

import Home from '../pages/Home.vue'
import Login from '../pages/Login.vue'
import Register from '../pages/Register.vue'
import Dashboard from '../pages/Dashboard.vue'

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
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },

    ]
})

export default router;
