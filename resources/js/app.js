import { createApp} from 'vue';
import App from "../src/App.vue";
import Navbar from '../src/Components/navbar/NavBar.vue'; // Asegúrate de proporcionar la ruta correcta

import { createRouter, createWebHistory } from 'vue-router';
import { routes } from './routes';
import 'flowbite';
import axios from 'axios';
import VueAxios from 'vue-axios';

const router = createRouter({
    history: createWebHistory(),
    routes
});
const app = createApp(App);
app.use(router);

app.use(VueAxios, axios);

app.mount('#app');