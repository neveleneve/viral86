import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { usePermissions } from "@/Composables/usePermissions"; // Pastikan path benar

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        const { can, canAny, canAll } = usePermissions();
        app.config.globalProperties.$can = can;
        app.config.globalProperties.$canAny = canAny;
        app.config.globalProperties.$canAll = canAll;
        app.mount(el);
    },
});
