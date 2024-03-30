<script setup>
import axios from "axios";
import { ref } from "vue";
import { useIntersectionObserver } from "@vueuse/core";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import Footer from "@/Components/Common/Footer.vue";
import BookCard from "@/Components/Book/BookCard.vue";

const props = defineProps({
	books: {
		type: Object,
		required: true,
	},
	booksCount: {
		type: Number,
		required: true,
	},
});

const $infiniteScrollingOffset = ref(null);

const { stop } = useIntersectionObserver(
	$infiniteScrollingOffset,
	([{ isIntersecting }]) => {
		if (!isIntersecting) {
			return;
		}

		if (props.books.meta.next_cursor) {
			axios
				.get(`${props.books.meta.path}?cursor=${props.books.meta.next_cursor}`)
				.then((response) => {
					props.books.data = [...props.books.data, ...response.data.data]; // eslint-disable-line
					props.books.meta = response.data.meta; // eslint-disable-line
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
		<main class="px-4 py-10 md:px-6 lg:px-16 xl:py-12 2xl:py-16">
			<h2 class="mb-6 text-xl font-bold">{{ booksCount }} books</h2>
			<!-- same breakpoints as swiperBreakpoints from the Index page -->
			<div
				class="mb-12 grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 lg:gap-4 2xl:grid-cols-8"
			>
				<BookCard
					v-for="(book, index) in books.data"
					:key="index"
					:book="book"
				/>
			</div>

			<div
				ref="$infiniteScrollingOffset"
				class="-translate-y-32"
			/>
		</main>

		<Footer />
	</div>
</template>
