require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import store from './store';
import { formatCPFCNPJ,formatEmail,validateEmail } from './helpers/helpers.js';
// bootstrap
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

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
import VueNouislider from 'vue3-nouislider';
import 'vue3-nouislider/dist/vue3-nouislider.css';

// vue input mask
import Maska from 'maska';

// smooth scroll
import { registerScrollSpy } from 'vue3-scroll-spy/dist/index';
//registerScrollSpy(app, { offset: 118 });

//vue-i18n
import i18n from './i18n';

// datatables
import { ClientTable } from 'v-tables-3';

// json to excel
import vue3JsonExcel from 'vue3-json-excel';

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
    resolve: (name) => require(`./views/${name}.vue`),
    setup({ el, app, props, plugin }){
        const apps = createApp({ render: () => h(app, props) });
        registerScrollSpy(apps, { offset: 118 });
        return apps
            .use(plugin)
            .use(store)
            .use(i18n)
            .use(PerfectScrollbar)
            .use(VueNouislider)
            .use(Maska)
            .use(ClientTable)
            .use(vue3JsonExcel)
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

InertiaProgress.init({ color: '#4B5563' });
