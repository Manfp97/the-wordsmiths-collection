import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { register } from "swiper/element/bundle";

register();

createInertiaApp({
	progress: {
		color: "#d62",
	},
	resolve: (name) => {
		const page = resolvePageComponent(
			`./Pages/${name}.vue`,
			import.meta.glob("./Pages/**/*.vue")
		);
		page.then((module) => {
			module.default.layout = module.default.layout || BaseLayout;
		});
		return page;
	},
	setup({ el, App, props, plugin }) {
		createApp({ render: () => h(App, props) })
			.use(plugin)
			.component("Link", Link)
			.mount(el);
	},
});
