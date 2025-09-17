import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
// Temporarily commented out due to import issues with new Inertia versions
// import { InertiaProgress } from '@inertiajs/progress';
import store from './store';
import { formatCPFCNPJ,formatEmail,validateEmail } from './helpers/helpers.js';
// bootstrap
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// tema global
import '@/assets/sass/app.scss'

// modals
import '@/assets/sass/components/custom-modal.scss';

// perfect scrollbar
import PerfectScrollbar from 'vue3-perfect-scrollbar';
import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css';

//vue-meta
import { createHead } from '@vueuse/head';
const head = createHead();

//Sweetalert
import Swal from 'sweetalert2';
window.Swal = Swal;

// nouislider - later remove and add to page due to not working in page
// Temporarily commented out due to Vite build issues with ES modules
// import VueNouislider from 'vue3-nouislider';
// import 'vue3-nouislider/dist/vue3-nouislider.css';

// vue input mask
import Maska from 'maska';

// smooth scroll
// Temporarily commented out due to import issues with Vite
// import { registerScrollSpy } from 'vue3-scroll-spy/dist/index';
//registerScrollSpy(app, { offset: 118 });

//vue-i18n
import i18n from './i18n';

// datatables
// Temporarily commented out due to ES module compatibility issues with Vite
// import { ClientTable } from 'v-tables-3';

// json to excel
// Temporarily commented out due to ES module compatibility issues with Vite
// import vue3JsonExcel from 'vue3-json-excel';

//vue-wizard
import VueFormWizard from 'vue3-form-wizard';
import 'vue3-form-wizard/dist/style.css';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
// set default settings
import appSetting from './app-setting';
window.$appSetting = appSetting;
window.$appSetting.init();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob('./views/**/*.vue', { eager: true });
        return pages[`./views/${name}.vue`];
    },
    setup({ el, App, props, plugin }){
        const apps = createApp({ render: () => h(App, props) });
        // registerScrollSpy(apps, { offset: 118 }); // Temporarily commented out
        return apps
            .use(plugin)
            .use(store)
            .use(i18n)
            .use(PerfectScrollbar)
            // .use(VueNouislider) // Commented out due to Vite build issues
            .use(Maska)
            // .use(ClientTable) // Commented out due to ES module issues
            // .use(vue3JsonExcel) // Commented out due to ES module issues
            .use(VueFormWizard)
            .use(head)
            .mixin({
                methods: {
                    route,formatCPFCNPJ,formatEmail,validateEmail,
                }
            })
            .mount(el);
    },
});

// InertiaProgress.init({ color: '#4B5563' }); // Commented out temporarily
