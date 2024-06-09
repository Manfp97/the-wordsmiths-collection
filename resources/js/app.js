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
		const app = createApp({ render: () => h(App, props) });

		return app
			.use(plugin)
			.use(i18nVue, {
				resolve: async (lang) => {
					const langs = import.meta.glob("../../lang/**/*.json");
					return await langs[`../../lang/${lang}/${lang}.json`]();
				},
				onLoad: () => {
					// return early if app is mounted already
					if (el && el.__vue_app__) {
						return;
					}
					app.mount(el); // Mounted here so translations are loaded before vue.
				},
			})
			.component("Link", Link);
	},
});
