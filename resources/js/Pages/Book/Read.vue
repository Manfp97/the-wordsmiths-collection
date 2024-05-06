<script setup>
import { ref, onBeforeUnmount } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import AppHead from "@/Components/Common/AppHead.vue";
import SimplePdfReader from "@/Components/Common/SimplePdfReader.vue";

const props = defineProps({
	pdfUrl: {
		type: String,
		required: true,
	},
	book: {
		type: Object,
		required: true,
	},
	bookmarkPage: {
		type: Number,
		required: false,
		default: 1,
	},
});

const page = ref(props.bookmarkPage);
const didClickClose = ref(false);

onBeforeUnmount(() => {
	if (!didClickClose.value) {
		postBookmark();
	}
});

const postBookmark = () => {
	if (props.bookmarkPage !== page.value) {
		router.post("/bookmark", {
			user_id: usePage().props.auth.user.id,
			book_id: props.book.id,
			page_number: page.value,
		});
	} else {
		router.visit(`/book/${props.book.slug}`);
	}
};

const onClose = () => {
	didClickClose.value = true;
	postBookmark();
};
</script>

<template>
	<AppHead :title="book.title" />
	<SimplePdfReader
		v-model:page="page"
		:pdf-source="pdfUrl"
		:initial-page="bookmarkPage"
		@close="onClose"
	/>
</template>
