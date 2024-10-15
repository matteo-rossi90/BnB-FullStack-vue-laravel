import { createRouter, createWebHistory } from "vue-router";
import {store} from '../store/store'

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
// // Condizioni per disabilitare rotte (esempio: autenticazione)
// router.beforeEach((to, from, next) => {
//     // Supponiamo di controllare se l'utente è autenticato
//     const isAuthenticated = store.user.id;

//     // Verifica se la rotta richiede autenticazione
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//       if (!isAuthenticated) {
//         // Se non autenticato, reindirizza alla pagina di login
//         return next({ name: 'login' });
//       }
//     }

//     // Se non ci sono restrizioni, continua la navigazione
//     next();
//   });

export default router;
