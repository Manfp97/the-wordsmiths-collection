<script setup>
const props = defineProps({
	book: {
		type: Object,
		required: true,
	},
});

const cover = props.book.responsive_cover.replaceAll(
	">",
	"class='h-full w-full'>"
);
</script>

<template>
	<div
		class="relative h-full select-none rounded-r-xl hover:ring-4 hover:ring-skin-card active:ring-skin-secondary"
		:title="book.title"
	>
		<p
			v-if="book.is_premium"
			class="absolute left-3 top-3 rounded bg-skin-text p-0.5 px-1 text-[0.5rem] font-bold uppercase xs:text-xs"
		>
			<span class="premium-gradient bg-clip-text text-transparent">
				Premium
			</span>
		</p>

		<!-- eslint-disable vue/no-v-text-v-html-on-component vue/no-v-html -->
		<Link
			:href="`/book/${book.slug}`"
			class="block h-full overflow-hidden rounded-r-xl"
			v-html="cover"
		/>
		<!--eslint-enable-->
	</div>
</template>
