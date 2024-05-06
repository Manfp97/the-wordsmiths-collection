<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";

const props = defineProps({
	title: {
		type: String,
		required: false,
		default: "",
	},
	description: {
		type: String,
		required: false,
		default: () => trans("common.page.description"),
	},
});

const appName = usePage().props.appName;
const title =
	props.title.trim() === "" ? appName : `${props.title} | ${appName}`;
</script>

<template>
	<Head>
		<title>{{ title }}</title>
		<meta
			name="description"
			:content="description"
			head-key="description"
		/>
		<link
			rel="icon"
			type="image/svg+xml"
			href="/favicon.svg"
		/>
		<slot />
	</Head>
</template>
