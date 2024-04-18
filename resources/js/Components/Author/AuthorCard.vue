<script setup>
defineProps({
	author: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<div class="flex flex-col items-center space-y-2">
		<!-- eslint-disable vue/no-v-html vue/no-v-text-v-html-on-component -->
		<Link
			:href="`/author/${author.slug}`"
			class="block h-full overflow-hidden rounded hover:ring-4 hover:ring-skin-card active:ring-skin-secondary"
			v-html="author.responsive_portrait"
		/>
		<!--eslint-enable-->
		<p class="font-bold">{{ author.first_name }} {{ author.last_name }}</p>
	</div>
</template>
