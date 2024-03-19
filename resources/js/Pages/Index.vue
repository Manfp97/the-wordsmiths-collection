<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import Footer from "@/Components/Common/Footer.vue";
import IndexBookCard from "@/Components/Index/IndexBookCard.vue";
import IndexBooksRow from "@/Components/Index/IndexBooksRow.vue";

defineProps({
	categories: {
		type: Array,
		required: true,
	},
});
</script>

<template>
	<AppHead />

	<Nav
		nav-class="lg:px-12"
		:should-wrap-in-container="false"
	/>

	<div class="page-container">
		<div
			class="hero relative h-[25vh] min-h-[10rem] w-full bg-cover bg-center pb-3 text-skin-primary md:min-h-[14rem]"
		>
			<div
				id="hero-content"
				class="absolute left-1/2 top-1/2 w-full -translate-x-1/2 -translate-y-1/2 px-4 text-center"
			>
				<h1
					class="font-means-web text-4xl font-bold !leading-[1.175] sm:text-5xl lg:text-6xl 2xl:text-7xl"
				>
					What are you going to read today?
				</h1>
			</div>
		</div>

		<main
			class="space-y-12 py-10 sm:space-y-10 lg:space-y-14 xl:py-12 2xl:py-16"
		>
			<IndexBooksRow
				v-for="(category, indexCategory) in categories"
				:key="indexCategory"
				:section-title="category.name"
			>
				<swiper-slide
					v-for="(book, indexBook) in category.books.concat(
						category.books.concat(category.books.concat())
					)"
					:key="indexBook"
					class="my-1 h-auto"
				>
					<IndexBookCard :book="book" />
				</swiper-slide>
			</IndexBooksRow>
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
