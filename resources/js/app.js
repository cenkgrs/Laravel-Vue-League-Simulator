import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import 'primeicons/primeicons.css';  // PrimeIcons
import 'primeflex/primeflex.css';    // PrimeFlex
import MainComponent from './components/MainComponent.vue'
import Lara from '@primeuix/themes/lara';

const app = createApp({});
app.use(PrimeVue, {
    theme: {
        preset: Lara
    }
});

app.component('counter', MainComponent)
app.mount('#app');