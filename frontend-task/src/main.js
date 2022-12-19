import { createApp } from 'vue'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import App from './App.vue'
import router from './router'
import store from './store'

const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
  };

createApp(App).use(router).use(store).use(VueSweetalert2,options).mount('#app')
