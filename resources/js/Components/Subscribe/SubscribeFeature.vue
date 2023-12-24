<script setup>
defineProps({
	title: String,
	body: String,
	imagePath: String,
});
</script>

<template>
	<section
		class="flex flex-wrap items-center even:flex-row-reverse max-lg:border-skin-border max-lg:[&:not(:last-child)]:border-b-2"
	>
		<div class="basis-full lg:basis-1/2">
			<div class="mx-2 sm:mx-8">
				<h2
					class="section-title mb-3 font-means-web md:mb-5 xl:mb-7 max-lg:text-center"
				>
					{{ title }}
				</h2>
				<div
					v-html="body"
					class="mb-6 text-lg !leading-snug lg:text-2xl max-lg:text-center"
				/>
			</div>
		</div>
		<div class="basis-full lg:basis-1/2 max-xs:mb-5">
			<img
				class="m-auto block w-11/12"
				:src="imagePath"
				:alt="`${title} image`"
			/>
		</div>
	</section>
</template>
