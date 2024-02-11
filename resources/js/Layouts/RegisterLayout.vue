<script setup>
import Logo from "@/Components/Common/Logo.vue";
import PricingCardListItem from "@/Components/Pricing/PricingCardListItem.vue";
import RegisterStep from "@/Components/Register/RegisterStep.vue";
import Footer from "@/Components/Common/Footer.vue";

defineProps({
	headerTitle: {
		type: String,
		required: true,
	},
	subscriptionPlan: {
		type: Object,
		required: true,
	},
	currentStep: {
		type: Number,
		required: true,
	},
});
</script>

<template>
	<div class="flex min-h-screen flex-col">
		<div class="flex flex-wrap lg:flex-1">
			<section
				class="flex w-full flex-col items-center bg-skin-secondary-offset py-12 lg:w-1/3"
			>
				<div class="px-4 pb-12">
					<Logo size="md" />
				</div>

				<div class="w-80 rounded-lg bg-skin-white bg-opacity-30 p-8 lg:w-2/3">
					<h2 class="mb-2 text-2xl font-bold">Your selected plan</h2>
					<h3 class="text-xl">{{ subscriptionPlan.name }}</h3>
					<ul
						role="list"
						class="mb-7 mt-4 space-y-3 text-left"
					>
						<PricingCardListItem
							v-for="(feature, index) in subscriptionPlan.features"
							:key="index"
							:is-check="feature.isCheck"
							:text="feature.text"
						/>
					</ul>

					<Link
						href="/pricing"
						class="mx-auto block w-full rounded border border-skin-secondary px-5 py-2.5 text-center font-bold hover:bg-skin-secondary-offset"
					>
						Change plan
					</Link>
				</div>
			</section>

			<section
				id="form"
				class="relative flex w-full flex-col items-center px-6 py-12 lg:w-2/3 lg:px-12"
			>
				<div class="mt-3 max-w-[36rem] lg:min-w-[28rem] max-lg:w-full">
					<div class="mx-auto w-full max-w-md px-8 pb-20 sm:px-0">
						<div class="relative">
							<div
								class="absolute left-0 top-2 h-0.5 w-full bg-skin-border"
								aria-hidden="true"
							>
								<div
									v-if="currentStep > 1"
									class="absolute h-full bg-gray-900"
									:class="{
										'w-1/2': currentStep === 2,
										'w-full': currentStep >= 3,
									}"
								/>
							</div>
							<ul class="relative flex w-full justify-between">
								<RegisterStep
									step-number="1"
									step-name="Account"
									step-name-position="-right-5"
									:url="currentStep >= 1 ? '/register/account' : null"
									:is-done="currentStep >= 1"
									:is-selected="currentStep == 1"
								/>

								<RegisterStep
									step-number="2"
									step-name="Verification"
									step-name-position="-right-8"
									:url="currentStep >= 2 ? '/register/verification' : null"
									:is-done="currentStep >= 2"
									:is-selected="currentStep === 2"
								/>

								<RegisterStep
									step-number="3"
									step-name="Payment"
									step-name-position="-right-6"
									:url="currentStep >= 3 ? '/register/payment' : null"
									:is-done="currentStep >= 3"
									:is-selected="currentStep === 3"
								/>
							</ul>
						</div>
					</div>
					<h2 class="text-center font-means-web text-4xl font-semibold">
						{{ headerTitle }}
					</h2>
					<div class="mt-8 flex w-full flex-col pb-8">
						<slot />
					</div>
				</div>
			</section>
		</div>

		<Footer />
	</div>
</template>
