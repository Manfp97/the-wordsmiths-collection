<script setup>
const props = defineProps({
	author: {
		type: Object,
		required: true,
	},
});

const image = props.author.responsive_portrait
	? props.author.responsive_portrait
	: `<img src="/images/author/placeholder.png" alt="Placeholder image for ${props.author.first_name} ${props.author.last_name}" />`;
</script>

<template>
	<div class="flex flex-col items-center space-y-2">
		<!-- eslint-disable vue/no-v-html vue/no-v-text-v-html-on-component -->
		<Link
			:href="`/author/${author.slug}`"
			class="block h-full overflow-hidden rounded hover:ring-4 hover:ring-skin-card active:ring-skin-secondary"
			v-html="image"
		/>
		<!--eslint-enable-->
		<p class="font-bold">{{ author.first_name }} {{ author.last_name }}</p>
	</div>
</template>
