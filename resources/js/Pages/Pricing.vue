<script setup>
import { usePage } from "@inertiajs/vue3";
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

	<Nav />

	<div class="page-container">
		<main class="container">
			<div class="mx-auto pb-8 pt-12 lg:px-6 lg:pb-16">
				<section class="mx-auto mb-8 text-center lg:mb-12">
					<h2 class="section-title mb-4">Choose the right plan for you</h2>
					<p class="md:text-xl">
						Go <span class="font-bold">Basic</span> or
						<span class="font-bold">Premium</span> to start reading The
						Wordsmith's Collection library now.
					</p>
					<p class="mb-5 md:text-xl">Change or cancel your plan anytime.</p>
				</section>

				<section class="mx-4">
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
						>
							<template #button>
								<Link
									href="/pricing/2"
									method="post"
									as="button"
									class="button py-2.5 font-bold capitalize"
								>
									Get started
								</Link>
							</template>
						</PricingCard>

						<PricingCard
							title="Premium"
							description="Exclusive access to a curated collection of Premium books that offer unparalleled depth of knowledge and entertainment."
							price-int-part="6"
							price-decimal-part="99"
							currency="€"
							:features="premiumFeatures"
							should-highlight
							class="w-full"
						>
							<template #button>
								<Link
									href="/pricing/1"
									method="post"
									as="button"
									class="button py-2.5 font-bold capitalize"
								>
									Get started
								</Link>
							</template>
						</PricingCard>
					</div>

					<div
						v-if="usePage().props.errors.subscription_plan_id"
						class="mx-auto mt-6 max-w-5xl text-center text-skin-danger"
					>
						{{ usePage().props.errors.subscription_plan_id }}
					</div>
				</section>
			</div>
		</main>

		<Footer />
	</div>
</template>
