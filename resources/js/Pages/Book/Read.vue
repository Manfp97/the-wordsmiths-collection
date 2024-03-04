<script setup>
import { router } from "@inertiajs/vue3";
import AppHead from "@/Components/Common/AppHead.vue";
import SimplePdfReader from "@/Components/Common/SimplePdfReader.vue";

const props = defineProps({
	pdfUrl: {
		type: String,
		required: true,
	},
	bookTitle: {
		type: String,
		required: true,
	},
	bookSlug: {
		type: String,
		required: true,
	},
	bookmarkPage: {
		// TODO in controller
		type: Number,
		required: false,
		default: 1,
	},
});

const handleClose = () => {
	// AJAX POST request to bookmark. In the promise, put the following line at the end:
	router.visit(`/book/${props.bookSlug}`);
};
</script>

<template>
	<AppHead :title="bookTitle" />
	<SimplePdfReader
		:pdf-source="pdfUrl"
		:initial-page="bookmarkPage"
		@close="handleClose"
	/>
</template>
