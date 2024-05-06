<script setup>
import { trans } from "laravel-vue-i18n";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import SubscribeFeature from "@/Components/Subscribe/SubscribeFeature.vue";
import SubscribeFaqs from "@/Components/Subscribe/SubscribeFaqs.vue";
import PricingCard from "@/Components/Pricing/PricingCard.vue";
import Footer from "@/Components/Common/Footer.vue";

const commonPlanFeatures = [
	{
		isCheck: true,
		text: trans("page.subscribe.common_plan_feature_1"),
	},
	{
		isCheck: true,
		text: trans("page.subscribe.common_plan_feature_2"),
	},
];

const planBasicFeatures = commonPlanFeatures.concat([
	{
		isCheck: false,
		text: trans("page.subscribe.premium_plan_feature_1"),
	},
]);

const planPremiumFeatures = commonPlanFeatures.concat([
	{
		isCheck: true,
		text: trans("page.subscribe.premium_plan_feature_1"),
	},
]);

const serviceFeatures = [
	{
		title: trans("page.subscribe.service_feature_1.title"),
		body: trans("page.subscribe.service_feature_1.body"),
		imagePath: "/images/subscribe/feature-1.webp",
	},
	{
		title: trans("page.subscribe.service_feature_2.title"),
		body: trans("page.subscribe.service_feature_2.body"),
		imagePath: trans("page.subscribe.service_feature_2.image"),
	},
	{
		title: trans("page.subscribe.service_feature_3.title"),
		body: trans("page.subscribe.service_feature_3.body"),
		imagePath: "/images/subscribe/feature-3.png",
	},
];

const faqs = [
	{
		id: 0,
		title: trans("faq.1.title"),
		body: trans("faq.1.body"),
	},
	{
		id: 1,
		title: trans("faq.2.title"),
		body: trans("faq.2.body"),
	},
	{
		id: 2,
		title: trans("faq.3.title"),
		body: trans("faq.3.body"),
	},
	{
		id: 3,
		title: trans("faq.4.title"),
		body: trans("faq.4.body"),
	},
	{
		id: 4,
		title: trans("faq.5.title"),
		body: trans("faq.5.title"),
	},
];
</script>

<template>
	<AppHead
		:title="trans('page.subscribe.title')"
		:description="trans('page.subscribe.description')"
	/>

	<BaseLayout>
		<Nav />

		<div class="min-h-screen">
			<section class="hero bg-cover bg-center pb-16 pt-32">
				<div class="px-8 text-center">
					<header class="text-skin-primary">
						<!-- eslint-disable vue/no-v-html -->
						<h1
							class="font-means-web text-4xl font-bold !leading-[1.175] sm:text-6xl 2xl:text-7xl"
							v-html="trans('page.subscribe.header')"
						/>
						<h3 class="my-2 text-lg sm:my-5 sm:text-2xl">
							{{ trans("page.subscribe.subheader") }}
						</h3>
					</header>

					<div
						class="mx-auto my-10 max-w-5xl text-skin-text sm:grid sm:grid-cols-2 sm:gap-6 md:gap-10 lg:gap-16 max-sm:space-y-10"
					>
						<PricingCard
							:title="trans('pricing_card.basic.title')"
							:description="trans('pricing_card.basic.description')"
							price-int-part="4"
							price-decimal-part="99"
							currency="€"
							:features="planBasicFeatures"
							:should-highlight="false"
							class="w-full"
						>
							<template #button>
								<Link
									href="/subscription-plan/2"
									method="post"
									as="button"
									class="button py-2.5 font-bold capitalize"
								>
									{{ trans("common.action.continue") }}
								</Link>
							</template>
						</PricingCard>

						<PricingCard
							:title="trans('pricing_card.premium.title')"
							:description="trans('pricing_card.premium.description')"
							price-int-part="6"
							price-decimal-part="99"
							currency="€"
							:features="planPremiumFeatures"
							should-highlight
							class="w-full"
						>
							<template #button>
								<Link
									href="/subscription-plan/1"
									method="post"
									as="button"
									class="button py-2.5 font-bold capitalize"
								>
									{{ trans("common.action.continue") }}
								</Link>
							</template>
						</PricingCard>
					</div>

					<p class="text-sm text-skin-primary md:text-base">
						{{ trans("page.subscribe.cancel_anytime") }}
					</p>
				</div>
			</section>

			<main>
				<div class="container my-2 sm:my-10 md:mb-20 md:mt-8 lg:my-16 xl:my-24">
					<div class="mx-4">
						<SubscribeFeature
							v-for="serviceFeature in serviceFeatures"
							:key="serviceFeature"
							:title="serviceFeature.title"
							:body="serviceFeature.body"
							:image-path="serviceFeature.imagePath"
							class="py-8 sm:py-12 md:py-16"
						/>
					</div>
				</div>

				<section
					class="discover__section grid h-[36rem] place-items-center sm:h-[40rem]"
				>
					<div
						class="mx-8 grid h-[21.125rem] place-items-center rounded-lg bg-skin-tertiary px-8 text-center lg:w-[48rem]"
					>
						<div class="lg:max-w-lg">
							<p
								class="font-means-web text-3xl leading-tight text-skin-primary sm:text-4xl"
								v-html="trans('page.subscribe.discover_now')"
							/>
							<a
								href="#"
								class="button button-subscribe mt-6"
							>
								{{ trans("page.subscribe.subscribe_now") }}
							</a>
						</div>
					</div>
				</section>

				<div class="container mb-16 mt-3 lg:mb-20">
					<div class="mx-8">
						<SubscribeFaqs :faqs="faqs" />
						<section class="mx-auto mt-5 max-w-3xl text-center">
							<h3
								class="section-title !leading-[1.175]"
								v-html="trans('page.subscribe.start_now')"
							/>
							<a
								href="#"
								class="button button-subscribe mt-6"
							>
								{{ trans("page.subscribe.subscribe_now") }}
							</a>
						</section>
					</div>
				</div>
			</main>

			<Footer />
		</div>
	</BaseLayout>
</template>

<style scoped>
.hero {
	background-image: linear-gradient(
			to top,
			rgba(0, 0, 0, 0.8) 0,
			rgba(0, 0, 0, 0) 60%,
			rgba(0, 0, 0, 0.9) 100%
		),
		url(/images/subscribe/header-image.webp);
}

.discover__section {
	background: repeat rgb(245, 246, 248) 50% 50% / cover;
	background-image: url(/images/subscribe/bottom-image.webp);
}

.button-subscribe {
	@apply px-8 text-lg font-bold lg:px-12 lg:text-xl;
}
</style>
