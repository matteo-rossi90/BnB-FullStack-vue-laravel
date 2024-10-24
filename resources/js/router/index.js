import { createRouter, createWebHistory } from "vue-router";


import Home from '../pages/Home.vue'
import Login from '../pages/Login.vue'
import NotFoundComponent from '../pages/NotFoundComponent.vue'
import Register from '../pages/Register.vue'
import Dashboard from '../pages/Ura/Dashboard.vue'
import CreateApartment from '../pages/Ura/CreateApartment.vue'
import IndexApartment from "../pages/Ura/IndexApartment.vue";
import Messages from "../pages/Ura/Messages.vue";
import Sponsor from "../pages/Ura/Sponsor.vue";
import ShowApartment from "../pages/Ura/ShowApartment.vue";
import EditApartment from "../pages/Ura/EditApartment.vue";
import Apartments from "../pages/Apartments.vue";
import PaymentComponent from "../pages/components/PaymentComponent.vue";
import CheckoutPayment from "../pages/components/CheckoutPayment.vue";

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
                path: '/lista-messaggi/:id/messaggi',
                name: 'messages',
                component: Messages
            },
            {
                path: '/sponsor',
                name: 'sponsor',
                component: Sponsor
            },
            {
                path: '/nuovo-appartamento',
                name: 'createApartment',
                component: CreateApartment
            },
            {
                // path: '/dettaglio-appartamento',
                path: '/appartamento-singolo/:slug/:id',
                name: 'showApartment',
                component: ShowApartment
            },{
                path: '/modifica-appartamento/:id',
                name: 'EditApartment',
                component: EditApartment
            },
            {
                path: '/appartamenti-ricerca',
                name: 'apartmentsMap',
                component: Apartments //route temporanea per visualizzare gli appartamenti + mappa
            },
            {
                path: '/payment/:id',
                name: 'payment',
                component: PaymentComponent //route temporanea per visualizzare gli appartamenti + mappa
            },
            {
                path: '/payment/:id/sponsor/:sponsor',
                name: 'checkout',
                component: CheckoutPayment //route temporanea per visualizzare gli appartamenti + mappa
            },
            {
                path: '/:pathMatch(.*)*',
                name: 'NotFound',
                component: NotFoundComponent,
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
