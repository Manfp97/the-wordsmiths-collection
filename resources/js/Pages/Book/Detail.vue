<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import Review from "@/Components/Review/Review.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import SwiperSection from "@/Components/Swiper/SwiperSection.vue";
import {
	default as SwiperNavigation,
	navigation,
} from "@/Components/Swiper/SwiperNavigation.vue";
import Footer from "@/Components/Common/Footer.vue";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormReview from "@/Forms/FormReview.vue";
import IconBook from "@icons/book.svg?component";

const props = defineProps({
	book: {
		type: Object,
		required: true,
	},
	relatedBooks: {
		type: Array,
		required: false,
		default: null,
	},
	canPublishReview: {
		type: Boolean,
		required: true,
	},
});

const isReviewing = ref(false);

const subscription = usePage().props.auth.subscription;

const isSubscriptionActive = subscription?.status === "active";
const canReadPremiumBook = props.book.isPremium
	? subscription?.subscription_plan_id === 1
	: true;

const readButtonText = computed(() => {
	if (isSubscriptionActive && canReadPremiumBook) {
		return "Read";
	} else if (isSubscriptionActive && !canReadPremiumBook) {
		return "Upgrade to premium";
	} else {
		return "Subscribe";
	}
});

const readButtonHref = computed(() => {
	if (isSubscriptionActive && canReadPremiumBook) {
		return `/book/${props.book.slug}/read`;
	} else if (isSubscriptionActive && !canReadPremiumBook) {
		return "/profile";
	} else {
		return "/subscribe";
	}
});

const cover = props.book.cover.replaceAll(">", "class='rounded-r-xl'>");

const swiperBreakpoints = {
	0: {
		slidesPerView: 3,
		spaceBetween: 12,
	},
	640: {
		slidesPerView: 4,
		spaceBetween: 18,
	},
	1024: {
		slidesPerView: 5,
		spaceBetween: 28,
	},
};
</script>

<template>
	<AppHead
		:title="book.title"
		description="Looking for more information about plans and pricing for The Wordsmith's Collection? Find all the information you need about the Basic and Premium plans."
	/>

	<Nav />

	<div class="page-container">
		<main class="mx-auto mb-20 mt-10 max-w-7xl sm:mb-32">
			<div class="mx-4">
				<div class="md:grid md:grid-cols-6 lg:grid-cols-12 max-md:space-y-10">
					<!-- Left column -->
					<div class="md:col-span-2 lg:col-span-3">
						<div class="sticky top-24">
							<!-- eslint-disable vue/no-v-html -->
							<div
								class="mx-auto w-[70%]"
								v-html="cover"
							/>
							<!-- eslint-enable -->
							<div class="mt-6 flex w-full justify-center">
								<Link
									:href="readButtonHref"
									class="button w-full !rounded-3xl text-lg font-bold lg:text-xl max-md:max-w-sm"
									:class="{ 'premium-gradient': book.isPremium }"
									as="button"
								>
									<IconBook class="mr-2 w-6" />
									{{ readButtonText }}
								</Link>
							</div>

							<div class="mt-3 text-center text-sm text-skin-muted">
								<p v-if="book.isPremium">
									Book available for <strong>Premium</strong> subscriptions
								</p>
								<p v-else>
									Book available for <strong>Basic</strong> and
									<strong>Premium</strong> subscriptions
								</p>
							</div>
						</div>
					</div>

					<!-- Right column -->
					<div class="md:col-span-4 md:ml-8 lg:col-span-9 lg:ml-14">
						<section>
							<h2 class="section-title">{{ book.title }}</h2>

							<div class="my-2 font-means-web text-2xl sm:my-4">
								<span
									v-for="(author, index) in book.authors"
									:key="index"
								>
									<Link
										:href="`/author/${author.slug}`"
										class="underline hover:text-skin-muted"
									>
										{{ author.name }}
									</Link>
									<span v-if="index + 1 < book.authors.length">, </span>
								</span>
							</div>

							<p>{{ book.description }}</p>

							<div class="mt-3 flex items-center space-x-4">
								<span class="text-skin-muted">Genres</span>
								<Link
									v-for="(category, index) in book.categories"
									:key="index"
									:href="`/category/${category.slug}`"
									class="font-bold underline decoration-skin-secondary decoration-[3px] underline-offset-4 hover:decoration-skin-tertiary"
								>
									{{ category.name }}
								</Link>
							</div>

							<div class="mt-4 grid w-fit grid-cols-2 gap-10">
								<div class="text-skin-muted">
									<p>Page count</p>
									<p>Publishing year</p>
									<p>Language</p>
									<p>ISBN</p>
								</div>

								<div>
									<p>{{ book.pageCount }} pages</p>
									<p>{{ book.year }}</p>
									<p>{{ book.language }}</p>
									<p>{{ book.isbn }}</p>
								</div>
							</div>
						</section>

						<hr class="my-8 border border-skin-border" />

						<section>
							<h3 class="mb-6 font-means-web text-3xl font-bold">Reviews</h3>

							<div
								v-if="book.reviews.length"
								class="space-y-6"
							>
								<Review
									v-for="(review, index) in book.reviews"
									:key="index"
									:book-id="book.id"
									:review="review"
								/>
							</div>
							<div
								v-else
								class="space-y-6"
							>
								No one has reviewed this book yet.
							</div>

							<div class="mt-8 flex items-center justify-center">
								<button
									v-if="canPublishReview"
									class="button px-10 font-bold"
									type="button"
									@click="isReviewing = true"
								>
									Write a review
								</button>
							</div>
						</section>
					</div>
				</div>

				<hr
					v-if="relatedBooks.length"
					class="my-8 border border-skin-border md:my-10"
				/>

				<div
					v-if="relatedBooks.length"
					class="mt-8 overflow-hidden"
				>
					<SwiperSection
						:breakpoints="swiperBreakpoints"
						:navigation="navigation"
					>
						<template #header>
							<div class="mb-6 flex items-center justify-between">
								<h3 class="font-means-web text-3xl font-bold">Related books</h3>
								<SwiperNavigation />
							</div>
						</template>

						<swiper-slide
							v-for="(relatedBook, index) in relatedBooks"
							:key="index"
							class="my-1 h-auto"
						>
							<BookCard :book="relatedBook" />
						</swiper-slide>
					</SwiperSection>
				</div>
			</div>
		</main>

		<Footer />
	</div>

	<ModalContainer
		modal-id="modal-review"
		:modal-title="`'${book.title}' review`"
		:show="isReviewing"
		@close="isReviewing = false"
	>
		<FormReview
			:book-id="book.id"
			http-method="post"
		/>
	</ModalContainer>
</template>
