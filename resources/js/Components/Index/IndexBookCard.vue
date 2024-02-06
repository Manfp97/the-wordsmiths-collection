<script setup>
const props = defineProps({
	book: {
		type: Object,
		required: true,
	},
});

const cover = props.book.cover.replaceAll(">", "class='h-full w-full'>"); // object-cover
</script>

<template>
	<div
		class="h-full select-none rounded-r-xl hover:ring-4 hover:ring-skin-card active:ring-skin-secondary"
		:title="book.title"
	>
		<!-- eslint-disable vue/no-v-text-v-html-on-component vue/no-v-html -->
		<Link
			:href="`/book/${book.slug}`"
			class="block h-full overflow-hidden rounded-r-xl"
			v-html="cover"
		/>
		<!--eslint-enable-->
	</div>
</template>
