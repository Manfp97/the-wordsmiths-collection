<script setup>
import axios from "axios";
import { usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { useIntersectionObserver } from "@vueuse/core";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import SwiperSection from "@/Components/Swiper/SwiperSection.vue";
import Footer from "@/Components/Common/Footer.vue";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormCategory from "@/Forms/FormCategory.vue";
import IconTrash from "@icons/trash.svg?component";
import IconEdit from "@icons/edit.svg?component";

const props = defineProps({
	categories: {
		type: Object,
		required: true,
	},
});

const swiperBreakpoints = {
	0: {
		slidesPerView: 3,
		spaceBetween: 8,
	},
	640: {
		slidesPerView: 4,
		spaceBetween: 8,
	},
	768: {
		slidesPerView: 5,
		spaceBetween: 8,
	},
	1024: {
		slidesPerView: 6,
		spaceBetween: 16,
	},
	1536: {
		slidesPerView: 8,
		spaceBetween: 16,
	},
};

const $infiniteScrollingOffset = ref(null);
const categoriesState = ref({
	data: props.categories.data,
	meta: props.categories.meta,
});

const selectedCategory = ref(null);
const isDeleting = ref(false);
const isEditing = ref(false);

const user = computed(() => usePage().props.auth.user);
const isAdmin = user.value?.role_id === 1;

const { stop } = useIntersectionObserver(
	$infiniteScrollingOffset,
	([{ isIntersecting }]) => {
		if (!isIntersecting) {
			return;
		}

		const meta = categoriesState.value.meta;
		if (meta.next_cursor) {
			axios.get(`${meta.path}?cursor=${meta.next_cursor}`).then((response) => {
				categoriesState.value.data = [
					...categoriesState.value.data,
					...response.data.data,
				];
				categoriesState.value.meta = response.data.meta;
			});
		} else {
			stop();
		}
	}
);

const askToDeleteCategory = (category) => {
	selectedCategory.value = category;
	isDeleting.value = true;
};

const askToEditCategory = (category) => {
	selectedCategory.value = category;
	isEditing.value = true;
};
</script>

<template>
	<AppHead />

	<Nav />

	<div class="page-container">
		<div
			class="hero relative h-[25vh] min-h-[10rem] w-full bg-cover bg-center pb-3 text-skin-primary md:min-h-[14rem]"
		>
			<div
				id="hero-content"
				class="absolute left-1/2 top-1/2 w-full -translate-x-1/2 -translate-y-1/2 px-4 text-center"
			>
				<h1
					class="font-means-web text-4xl font-bold !leading-[1.175] sm:text-5xl md:text-6xl xl:text-7xl 2xl:text-8xl"
				>
					What are you going to read today?
				</h1>
			</div>
		</div>

		<main
			class="space-y-12 py-10 sm:space-y-10 lg:space-y-14 xl:py-12 2xl:py-16"
		>
			<SwiperSection
				v-for="(category, indexCategory) in categoriesState.data"
				:key="indexCategory"
				:breakpoints="swiperBreakpoints"
			>
				<template #header>
					<div
						class="mb-4 flex items-center space-x-6 px-4 md:mb-6 md:px-6 lg:px-16"
					>
						<h2 class="text-xl font-bold md:text-2xl 2xl:text-3xl">
							{{ category.name }}
						</h2>
						<div class="flex space-x-1.5">
							<IconTrash
								v-if="isAdmin"
								class="w-8 cursor-pointer text-skin-danger"
								@click="askToDeleteCategory(category)"
							/>
							<IconEdit
								v-if="isAdmin"
								class="w-8 cursor-pointer text-skin-link"
								@click="askToEditCategory(category)"
							/>
						</div>
					</div>
				</template>

				<swiper-slide
					v-for="(book, indexBook) in category.books"
					:key="indexBook"
					class="my-1 h-auto"
				>
					<BookCard :book="book" />
				</swiper-slide>
			</SwiperSection>

			<div
				ref="$infiniteScrollingOffset"
				class="-translate-y-32"
			/>
		</main>

		<ModalContainer
			v-if="isAdmin"
			modal-id="modal-delete-category"
			modal-title="Delete category"
			:show="isDeleting"
			@close="isDeleting = false"
		>
			<div class="space-y-2">
				<p>
					Are you sure you want to delete the '{{ selectedCategory?.name }}'
					category? The books attached to it won't be deleted. This action
					cannot be undone.
				</p>
			</div>

			<div class="mt-6 flex justify-end space-x-4">
				<button
					class="button !bg-skin-muted text-skin-white"
					@click="isDeleting = false"
				>
					No
				</button>

				<Link
					:href="`/category/${selectedCategory?.id}`"
					method="delete"
					as="button"
					class="button !bg-skin-danger text-skin-white"
					:preserve-state="false"
					@click="isDeleting = false"
				>
					Yes
				</Link>
			</div>
		</ModalContainer>

		<ModalContainer
			v-if="isAdmin"
			modal-id="modal-edit-category"
			modal-title="Edit category"
			:show="isEditing"
			@close="isEditing = false"
		>
			<FormCategory
				:category="selectedCategory"
				http-method="put"
				:preserve-scroll="false"
				preserve-state="errors"
			/>
		</ModalContainer>
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
		url(/images/index/hero.jpg);
}
</style>
