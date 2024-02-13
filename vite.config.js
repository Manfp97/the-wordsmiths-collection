import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import svgLoader from "vite-svg-loader";
import { fileURLToPath, URL } from "url";

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
	resolve: {
		alias: {
			"@icons": fileURLToPath(
				new URL("./public/images/icons", import.meta.url)
			),
		},
	},
	optimizeDeps: { esbuildOptions: { target: "esnext" } },
});
