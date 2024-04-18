<script setup>
import axios from "axios";
import { ref } from "vue";
import { useIntersectionObserver } from "@vueuse/core";
import IndexLayout from "@/Layouts/IndexLayout.vue";
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
	<IndexLayout>
		<template #main>
			<div class="px-4 md:px-6 lg:px-16">
				<h2 class="index-title mb-6 font-bold">{{ booksCount }} books</h2>
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
			</div>
		</template>
	</IndexLayout>
</template>
