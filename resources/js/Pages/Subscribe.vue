<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import SubscribeFeature from "@/Components/Subscribe/SubscribeFeature.vue";
import SubscribeFaqs from "@/Components/Subscribe/SubscribeFaqs.vue";
import PricingCard from "@/Components/Pricing/PricingCard.vue";
import Footer from "@/Components/Common/Footer.vue";

const commonPlanFeatures = [
	{
		isCheck: true,
		text: "Write reviews",
	},
	{
		isCheck: true,
		text: "Read <span class='font-bold'>Basic</span> books",
	},
];

const planBasicFeatures = commonPlanFeatures.concat([
	{
		isCheck: false,
		text: "Read <span class='font-bold'>Premium</span> books",
	},
]);

const planPremiumFeatures = commonPlanFeatures.concat([
	{
		isCheck: true,
		text: "Read <span class='font-bold'>Premium</span> books",
	},
]);

const serviceFeatures = [
	{
		title: "Extensive curated library",
		body: "<p>Access to a vast and curated library of the most important literary works in history. <a href='/' class='underline hover:bg-skin-secondary-offset bg-skin-secondary'>Browse the library now</a>.</p>",
		imagePath: "/images/subscribe/feature-4.webp",
	},
	{
		title: "Explore community reviews",
		body: "<p>Users can rate and provide feedback on books, helping others make informed decisions about their reading choices.</p>",
		imagePath: "/images/subscribe/feature-4.webp",
	},
	{
		title: "Regular content updates",
		body: "<p>The library is constantly updated with new additions and timeless classics to keep the content fresh and engaging.</p>",
		imagePath: "/images/subscribe/feature-4.webp",
	},
	{
		title: "Read anywhere",
		body: "<p>Read unlimited books on your phone, tablet, computer, and eBook.</p>",
		imagePath: "/images/subscribe/feature-4.webp",
	},
];

const faqs = [
	{
		id: 0,
		title: "What is The Wordsmith's Collection?",
		body: "<p>The Wordsmith's Collection is a streaming service that offers a wide variety of literary works.</p><p>You can watch as much as you want, whenever you want, without a single ad – all for one low monthly price. There's always something new to discover, and new books are added every week!</p>",
	},
	{
		id: 1,
		title: "How much does The Wordsmith's Collection cost?",
		body: "<p>Read The Wordsmith's Collection on your smartphone, tablet, computer, or eBook, all for one fixed monthly fee. Plans range from 4.99€ to 6.99€ a month. No extra costs, no contracts.</p>",
	},
	{
		id: 2,
		title: "What titles can I read?",
		body: "<p>If you have a subscription, you can read the titles included in it as many times as you like. If you have a <strong>Premium</strong> subscription, you also have access to the books marked <strong>Premium</strong>.</p>",
	},
	{
		id: 3,
		title: "Where can I read?",
		body: "<p>Read anywhere, anytime. Sign in with your The Wordsmith's Collection account to read instantly on the web from your device, including smartphones, tablets, computers, and eBooks.</p>",
	},
	{
		id: 4,
		title: "How do I cancel?",
		body: "<p>The Wordsmith's Collection is flexible. There are no pesky contracts or commitments. You can easily cancel your account online with two clicks in your profile. There are no cancellation fees – start or stop your account at any time.</p>",
	},
];
</script>

<template>
	<AppHead
		title="Subscribe"
		description="Subscribe to The Wordsmith's Collection to read books directly on your computer, phone, tablet, eBook, and more."
	/>

	<Nav />

	<div class="min-h-screen">
		<section class="hero bg-cover bg-center pb-16 pt-32">
			<div class="px-8 text-center">
				<header class="text-skin-primary">
					<h1
						class="font-means-web text-4xl font-bold !leading-[1.175] sm:text-6xl 2xl:text-7xl"
					>
						Choose the plan that best suits
						<span class="text-skin-secondary">your needs</span>
					</h1>
					<h3 class="my-2 text-lg sm:my-5 sm:text-2xl">
						Explore, read, and relive literary classics anywhere at any time.
					</h3>
				</header>

				<div
					class="mx-auto my-10 max-w-5xl text-skin-text sm:grid sm:grid-cols-2 sm:gap-6 md:gap-10 lg:gap-16 max-sm:space-y-10"
				>
					<PricingCard
						title="Basic"
						description="Unlock a world of knowledge with our Basic plan, which gives you access to a vast library of essential literary works."
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
								Continue
							</Link>
						</template>
					</PricingCard>

					<PricingCard
						title="Premium"
						description="Exclusive access to a curated collection of Premium books that offer unparalleled depth of knowledge and entertainment."
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
								Continue
							</Link>
						</template>
					</PricingCard>
				</div>

				<p class="text-sm text-skin-primary md:text-base">Cancel anytime</p>
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
						>
							Discover now the book that will change your life for only
							<strong>4,99€</strong>
						</p>
						<a
							href="#"
							class="button button-subscribe mt-6"
						>
							Subscribe Now
						</a>
					</div>
				</div>
			</section>

			<div class="container mb-16 mt-3 lg:mb-20">
				<div class="mx-8">
					<SubscribeFaqs :faqs="faqs" />
					<section class="mx-auto mt-5 max-w-3xl text-center">
						<h3 class="section-title !leading-[1.175]">
							Ready to read?<br />
							Start your membership now
						</h3>
						<a
							href="#"
							class="button button-subscribe mt-6"
						>
							Subscribe Now
						</a>
					</section>
				</div>
			</div>
		</main>

		<Footer />
	</div>
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
