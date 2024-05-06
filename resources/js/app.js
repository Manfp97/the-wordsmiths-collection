import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { register } from "swiper/element/bundle";
import { i18nVue } from "laravel-vue-i18n";

register();

createInertiaApp({
	progress: {
		color: "#d62",
	},
	resolve: (name) =>
		resolvePageComponent(
			`./Pages/${name}.vue`,
			import.meta.glob("./Pages/**/*.vue")
		),
	setup({ el, App, props, plugin }) {
		createApp({ render: () => h(App, props) })
			.use(plugin)
			.use(i18nVue, {
				resolve: async (lang) => {
					const langs = import.meta.glob("../../lang/**/*.json");
					return await langs[`../../lang/${lang}/${lang}.json`]();
				},
			})
			.component("Link", Link)
			.mount(el);
	},
});
