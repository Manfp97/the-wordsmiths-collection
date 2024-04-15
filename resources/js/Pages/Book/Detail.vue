<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import Review from "@/Components/Review/Review.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import Rating from "@/Components/Common/Rating.vue";
import SwiperSection from "@/Components/Swiper/SwiperSection.vue";
import {
	default as SwiperNavigation,
	navigation,
} from "@/Components/Swiper/SwiperNavigation.vue";
import Footer from "@/Components/Common/Footer.vue";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormReview from "@/Forms/FormReview.vue";
import FormBook from "@/Forms/FormBook.vue";
import IconBook from "@icons/book.svg?component";
import IconTrash from "@icons/trash.svg?component";
import IconEdit from "@icons/edit.svg?component";

const props = defineProps({
	book: {
		type: Object,
		required: true,
	},
	relatedBooks: {
		type: Object,
		required: false,
		default: null,
	},
	canPublishReview: {
		type: Boolean,
		required: true,
	},
});

const canEdit = props.book.reviews.some((review) => review.can_edit);
const canDelete = props.book.reviews.some((review) => review.can_delete);

const isEditingBook = ref(false);
const isDeletingBook = ref(false);

const isReviewing = ref(false);
const isEditingReview = ref(false);
const isDeletingReview = ref(false);

const selectedReview = ref(null);
const editReview = (review) => {
	selectedReview.value = review;
	isEditingReview.value = true;
};
const deleteReview = (review) => {
	selectedReview.value = review;
	isDeletingReview.value = true;
};
const closeEditReview = () => {
	isEditingReview.value = false;
	selectedReview.value = null;
};

const user = computed(() => usePage().props.auth.user);
const isAdmin = user.value?.role_id === 1;
const subscription = usePage().props.auth.subscription;

const isSubscriptionActive = subscription?.status === "active";
const canReadPremiumBook = props.book.is_premium
	? subscription?.subscription_plan_id === 1
	: true;

const readButtonInfo = computed(() => {
	if (isSubscriptionActive && canReadPremiumBook) {
		return { text: "Read", href: `/book/${props.book.slug}/read` };
	} else if (isSubscriptionActive && !canReadPremiumBook) {
		return { text: "Upgrade to premium", href: "/profile" };
	} else {
		return { text: "Subscribe", href: "/subscribe" };
	}
});

const cover = props.book.responsive_cover.replaceAll(
	">",
	"class='rounded-r-xl'>"
);

const swiperBreakpoints = {
	0: {
		slidesPerView: 2,
		spaceBetween: 12,
	},
	640: {
		slidesPerView: 3,
		spaceBetween: 12,
	},
	768: {
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
			<div class="mx-6 sm:mx-8 md:mx-10 lg:mx-12">
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
									:href="readButtonInfo.href"
									class="button w-full !rounded-3xl text-lg font-bold lg:text-xl max-md:max-w-sm"
									:class="{ 'premium-gradient': book.is_premium }"
									as="button"
								>
									<IconBook class="mr-2 w-6" />
									{{ readButtonInfo.text }}
								</Link>
							</div>

							<div class="mt-3 text-center text-sm text-skin-muted">
								<p v-if="book.is_premium">
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
							<div class="flex items-center space-x-3">
								<h2 class="section-title">{{ book.title }}</h2>
								<div class="flex space-x-1.5">
									<IconTrash
										v-if="isAdmin"
										class="w-6 cursor-pointer text-skin-danger md:w-8"
										@click="isDeletingBook = true"
									/>
									<IconEdit
										v-if="isAdmin"
										class="w-6 cursor-pointer text-skin-link md:w-8"
										@click="isEditingBook = true"
									/>
								</div>
							</div>

							<div class="my-2 font-means-web text-2xl sm:my-4">
								<span
									v-for="(author, index) in book.authors"
									:key="index"
								>
									<Link
										:href="`/author/${author.slug}`"
										class="underline hover:text-skin-muted"
									>
										{{ author.first_name }} {{ author.last_name }}
									</Link>
									<span v-if="index + 1 < book.authors.length">, </span>
								</span>
							</div>

							<p class="whitespace-pre-wrap">{{ book.description }}</p>

							<div class="mt-3 flex items-center space-x-4">
								<span class="text-skin-muted">Genres</span>
								<Link
									v-for="(genre, index) in book.genres"
									:key="index"
									:href="`/genre/${genre.slug}`"
									class="font-bold underline decoration-skin-secondary decoration-[3px] underline-offset-4 hover:decoration-skin-tertiary"
								>
									{{ genre.name }}
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
									<p>{{ book.page_count }} pages</p>
									<p>{{ book.year }}</p>
									<p>{{ book.language }}</p>
									<p>{{ book.isbn }}</p>
								</div>
							</div>
						</section>

						<hr class="my-8 border border-skin-border" />

						<section>
							<h3 class="mb-6 font-means-web text-3xl font-bold capitalize">
								Community reviews
							</h3>

							<div v-if="book.reviews.length">
								<div class="mb-8 flex items-center space-x-5">
									<div class="flex items-center space-x-2.5">
										<Rating
											:stars="1"
											:rating="1"
											icon-class="h-7 w-7"
											:editable="false"
										/>
										<span class="text-2xl"
											>{{ book.average_rating }} / 5.00</span
										>
									</div>
									<span class="text-sm text-skin-muted"
										>{{ book.rating_count }} ratings &#183;
										{{ book.review_count }} reviews</span
									>
								</div>

								<p class="mb-3 text-sm text-skin-muted">
									Displaying {{ book.rating_count }} ratings
								</p>

								<div class="space-y-6">
									<Review
										v-for="(review, index) in book.reviews"
										:key="index"
										:book-id="book.id"
										:review="review"
										@edit="editReview(review)"
										@delete="deleteReview(review)"
									/>
								</div>
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
					v-if="relatedBooks.data.length"
					class="my-8 border border-skin-border md:my-10"
				/>

				<div
					v-if="relatedBooks.data.length"
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
							v-for="(relatedBook, index) in relatedBooks.data"
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
			@success="isReviewing = false"
		/>
	</ModalContainer>

	<ModalContainer
		v-if="canDelete"
		modal-id="modal-delete-review"
		modal-title="Delete review"
		:show="isDeletingReview"
		@close="isDeletingReview = false"
	>
		<div class="space-y-2">
			<p>
				Are you sure you want to delete this review? This action cannot be
				undone.
			</p>
		</div>

		<div class="mt-6 flex justify-end space-x-4">
			<button
				class="button !bg-skin-muted text-skin-white"
				@click="isDeletingReview = false"
			>
				No
			</button>

			<Link
				:href="`/review/${selectedReview?.id}`"
				method="delete"
				as="button"
				class="button !bg-skin-danger text-skin-white"
				preserve-scroll
				@click="isDeletingReview = false"
			>
				Yes
			</Link>
		</div>
	</ModalContainer>

	<ModalContainer
		v-if="canEdit"
		modal-id="modal-edit-review"
		modal-title="Edit review"
		:show="isEditingReview"
		@close="closeEditReview"
	>
		<FormReview
			:book-id="book.id"
			:review="selectedReview"
			http-method="put"
			preserve-state="errors"
		/>
	</ModalContainer>

	<ModalContainer
		v-if="isAdmin"
		modal-id="modal-delete-book"
		modal-title="Delete book"
		:show="isDeletingBook"
		@close="isDeletingBook = false"
	>
		<div class="space-y-2">
			<p>
				Are you sure you want to delete this book? This action cannot be undone.
			</p>
		</div>

		<div class="mt-6 flex justify-end space-x-4">
			<button
				class="button !bg-skin-muted text-skin-white"
				@click="isDeletingBook = false"
			>
				No
			</button>

			<Link
				:href="`/book/${book?.id}`"
				method="delete"
				as="button"
				class="button !bg-skin-danger text-skin-white"
			>
				Yes
			</Link>
		</div>
	</ModalContainer>

	<ModalContainer
		v-if="isAdmin"
		modal-id="modal-edit-book"
		modal-title="Edit book"
		:show="isEditingBook"
		@close="isEditingBook = false"
	>
		<FormBook
			form-id="form-edit-book"
			:book="book"
			http-method="put"
			preserve-scroll
			preserve-state="errors"
		/>
	</ModalContainer>
</template>
