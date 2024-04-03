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
const booksState = ref({
	data: props.books.data,
	meta: props.books.meta,
});

const { stop } = useIntersectionObserver(
	$infiniteScrollingOffset,
	([{ isIntersecting }]) => {
		if (!isIntersecting) {
			return;
		}

		const meta = booksState.value.meta;
		if (meta.next_cursor) {
			axios.get(`${meta.path}?cursor=${meta.next_cursor}`).then((response) => {
				booksState.value.data = [
					...booksState.value.data,
					...response.data.data,
				];
				booksState.value.meta = response.data.meta;
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
					v-for="(book, index) in booksState.data"
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
