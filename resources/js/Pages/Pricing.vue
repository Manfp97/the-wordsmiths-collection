<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import PricingCard from "@/Components/Pricing/PricingCard.vue";
import Nav from "@/Components/Common/Nav.vue";
import Footer from "@/Components/Common/Footer.vue";

const commonFeatures = [
	{
		isCheck: true,
		text: "Write reviews",
	},
	{
		isCheck: true,
		text: "Read <span class='font-bold'>Basic</span> books",
	},
];

const basicFeatures = commonFeatures.concat([
	{
		isCheck: false,
		text: "Read <span class='font-bold'>Premium</span> books",
	},
]);

const premiumFeatures = commonFeatures.concat([
	{
		isCheck: true,
		text: "Read <span class='font-bold'>Premium</span> books",
	},
]);
</script>

<template>
	<AppHead
		title="Pricing"
		description="Looking for more information about plans and pricing for The Wordsmith's Collection? Find all the information you need about the Basic and Premium plans."
	/>

	<div class="min-h-screen">
		<Nav />

		<section class="mx-4 md:mx-6 lg:mx-8 xl:mx-36 2xl:mx-4">
			<div class="mx-auto pb-8 pt-12 lg:px-6 lg:pb-16">
				<div class="mx-auto mb-8 text-center lg:mb-12">
					<h2 class="section-title mb-4 xl:mb-7">
						Choose the right plan for you
					</h2>
					<p class="font-light sm:text-xl">
						Go <span class="font-bold">Basic</span> or
						<span class="font-bold">Premium</span> to start reading The
						Wordsmith's Collection library now.
					</p>
					<p class="mb-5 font-light sm:text-xl">
						Change or cancel your plan anytime.
					</p>
				</div>
				<div
					class="mx-auto max-w-5xl sm:grid sm:grid-cols-2 sm:gap-6 md:gap-10 lg:gap-16 max-sm:space-y-10"
				>
					<PricingCard
						title="Basic"
						description="Unlock a world of knowledge with our Basic plan, which gives you access to a vast library of essential literary works."
						price-int-part="4"
						price-decimal-part="99"
						currency="€"
						:features="basicFeatures"
						:should-highlight="false"
						class="w-full"
					/>
					<PricingCard
						title="Premium"
						description="Exclusive access to a curated collection of Premium books that offer unparalleled depth of knowledge and entertainment."
						price-int-part="6"
						price-decimal-part="99"
						currency="€"
						:features="premiumFeatures"
						should-highlight
						class="w-full"
					/>
				</div>
			</div>
		</section>

		<Footer />
	</div>
</template>
