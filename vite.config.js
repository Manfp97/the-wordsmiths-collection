import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import svgLoader from "vite-svg-loader";

export default defineConfig({
	plugins: [
		laravel({
			input: ["resources/css/app.css", "resources/js/app.js"],
			refresh: true,
		}),
		vue({
			script: {
				defineModel: true,
			},
			template: {
				compilerOptions: {
					isCustomElement: (tag) =>
						["swiper-container", "swiper-slide"].includes(tag),
				},
			},
		}),
		svgLoader(),
	],
});
