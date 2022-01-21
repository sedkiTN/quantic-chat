import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Layout from './Shared/Layout';
import ModalUserInfos from '@/Shared/ModalUserInfos';

createInertiaApp({
    resolve: async name => {
        let page = (await import(`./Pages/${name}`)).default;

        if(page.layout === undefined) page.layout = Layout;
        // page.layout ??= Layout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .component("Head", Head)
            .component("ModalUserInfos", ModalUserInfos)
            .mount(el)
    },

    title: title => `${title} - Quantic Chat`
});

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#3D44A0',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
});