import "./bootstrap";
// import {createApp} from "vue";
import {createApp} from 'vue/dist/vue.esm-bundler';
import {canAccess} from "@/utilities/permission.js";
import mitt from "mitt";

const emitter = mitt();
import Vue3Toasity, {toast} from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import {defineGlobalComponents} from "@/index.js";

const app = createApp({});
defineGlobalComponents(app);
app.use(Vue3Toasity, {
    position: 'top-center',
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    icon: true,
    rtl: false,
    autoClose: 2000,
})
app.config.globalProperties.emitter = emitter;
app.config.globalProperties.$canAccess = canAccess;
app.mount('#app')
