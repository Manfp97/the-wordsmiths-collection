<script setup>
defineProps({
	book: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<div
		class="my-1 select-none rounded hover:ring-4 hover:ring-skin-border active:ring-skin-secondary"
		:title="book.title"
	>
		<Link
			:href="`/book/${book.slug}`"
			class="bg-card block overflow-hidden rounded"
		>
			<img
				:src="book.imageUrl"
				draggable="false"
				class="lazy-loaded block h-full w-full object-cover"
				:alt="book.title"
			/>
		</Link>
	</div>
</template>

<style scoped>
.lazy-loaded {
	@apply opacity-100 transition-opacity duration-[.4s];
}
</style>
