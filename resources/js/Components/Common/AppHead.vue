<script setup>
import { Head, usePage } from "@inertiajs/inertia-vue3";

const props = defineProps({
	title: {
		type: String,
		required: false,
		default: "",
	},
	description: {
		type: String,
		required: true,
	},
});

const appName = usePage().props.value.appName;
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
