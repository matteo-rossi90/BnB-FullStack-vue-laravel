import './bootstrap';
import App from './App.vue'
import '../scss/_general.scss'
import { createApp } from 'vue';
import router from './router/index';

import '../scss/_variables.scss';
import '../scss/_dashboard.scss';

// Importa i core di FontAwesome
import { library } from '@fortawesome/fontawesome-svg-core';

// Importa il componente di FontAwesome
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

// Importa specifiche icone (in questo caso la caret-down)
import { faCaretDown } from '@fortawesome/free-solid-svg-icons';

// Aggiungi le icone alla libreria di Font Awesome
library.add(faCaretDown);

// Includo il file CSS e JavaScript di Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

const app = createApp(App)
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(router)
app.mount('#app')
