<script setup>
import PricingCardListItem from "@/Components/Pricing/PricingCardListItem.vue";
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
	title: String,
	description: String,
	priceIntPart: String,
	priceDecimalPart: String,
	currency: String,
	features: Array,
	shouldHighlight: Boolean,
});
</script>

<template>
	<div
		class="mx-auto rounded-lg"
		:class="{
			'bg-gradient-to-r from-[#fbc997] to-[#66afaf]': shouldHighlight,
			'bg-skin-secondary': !shouldHighlight,
		}"
	>
		<div class="m-1.5 rounded-lg max-md:py-1.5">
			<div
				class="flex flex-col rounded-lg p-6 text-center shadow xl:p-8"
				:class="{
					'bg-skin-primary': !shouldHighlight,
					'bg-skin-primary bg-opacity-70': shouldHighlight,
				}"
			>
				<h3
					class="mb-4 text-2xl font-semibold sm:text-3xl"
					:class="{ 'text-[#007a7a]': shouldHighlight }"
				>
					{{ title }}
				</h3>
				<p class="text-gray-500 font-light sm:text-lg">
					{{ description }}
				</p>
				<div class="my-6 flex items-baseline justify-center">
					<span class="mr-2 text-5xl font-extrabold">
						<span class="text-3xl font-normal mr-0.5">{{ currency }}</span>
						<span class="price">{{ priceIntPart }}</span>
						<sup class="-top-6 text-lg">{{ priceDecimalPart }}</sup>
					</span>
					<span class="text-gray-500">/month</span>
				</div>
				<!-- List -->
				<ul
					role="list"
					class="mb-8 space-y-4 text-left"
				>
					<PricingCardListItem
						v-for="feature in features"
						:key="feature"
						:isCheck="feature.isCheck"
						:text="feature.text"
					/>
				</ul>
				<Link
					href="/signup"
					class="focus:ring-skin-border rounded bg-skin-secondary px-5 py-2.5 text-center font-bold capitalize hover:bg-skin-secondary-offset focus:ring-4"
				>
					Get started
				</Link>
			</div>
		</div>
	</div>
</template>
