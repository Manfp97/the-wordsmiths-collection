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
	authors: {
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
const authorsState = ref({
	data: props.authors.data,
	meta: props.authors.meta,
});

const { stop } = useIntersectionObserver(
	$infiniteScrollingOffset,
	([{ isIntersecting }]) => {
		if (!isIntersecting) {
			return;
		}

		const meta = authorsState.value.meta;
		if (meta.next_cursor) {
			axios.get(`${meta.path}?cursor=${meta.next_cursor}`).then((response) => {
				authorsState.value.data = [
					...authorsState.value.data,
					...response.data.data,
				];
				authorsState.value.meta = response.data.meta;
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
		<main
			class="space-y-12 py-10 sm:space-y-10 lg:space-y-14 xl:py-12 2xl:py-16"
		>
			<SwiperSection
				v-for="(author, indexAuthor) in authorsState.data"
				:key="indexAuthor"
				:breakpoints="swiperBreakpoints"
			>
				<template #header>
					<h2
						class="mb-4 px-4 text-xl font-bold md:mb-6 md:px-6 md:text-2xl lg:px-16 2xl:text-3xl"
					>
						{{ author.first_name }} {{ author.last_name }}
					</h2>
				</template>

				<swiper-slide
					v-for="(book, indexBook) in author.books"
					:key="indexBook"
					class="my-1 h-auto"
				>
					<BookCard :book="book" />
				</swiper-slide>
			</SwiperSection>
		</main>

		<Footer />
	</div>
</template>
