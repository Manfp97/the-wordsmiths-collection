<script setup>
import axios from "axios";
import { ref } from "vue";
import { useIntersectionObserver } from "@vueuse/core";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import SwiperSection from "@/Components/Swiper/SwiperSection.vue";
import Footer from "@/Components/Common/Footer.vue";

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

const { stop } = useIntersectionObserver(
	$infiniteScrollingOffset,
	([{ isIntersecting }]) => {
		if (!isIntersecting) {
			return;
		}

		if (props.categories.meta.next_cursor) {
			axios
				.get(
					`${props.categories.meta.path}?cursor=${props.categories.meta.next_cursor}`
				)
				.then((response) => {
					categoriesState.value.data = [
						...props.categories.data,
						...response.data.data,
					];
					categoriesState.value.meta = response.data.meta;
				});
		} else {
			stop();
		}
	}
);
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
					<h2
						class="mb-4 px-4 text-xl font-bold md:mb-6 md:px-6 md:text-2xl lg:px-16 2xl:text-3xl"
					>
						{{ category.name }}
					</h2>
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
