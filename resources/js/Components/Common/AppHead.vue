<script setup>
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
	title: {
		type: String,
		required: true
	},
	description: {
		type: String,
		required: true
	},
});
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
