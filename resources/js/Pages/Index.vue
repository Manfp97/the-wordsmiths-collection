<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import Footer from "@/Components/Common/Footer.vue";
import IndexBookCard from "@/Components/Index/IndexBookCard.vue";
import IndexBooksRow from "@/Components/Index/IndexBooksRow.vue";

const book = {
	title: "Las Ocho Montañas",
	slug: "las-ocho-montañas",
	imageUrl: "/images/index/placeholder.webp",
};
</script>

<template>
	<AppHead />

	<div class="min-h-screen bg-skin-primary-dark">
		<div
			class="hero relative h-[25vh] min-h-[15rem] w-full bg-cover bg-center py-3 text-skin-primary"
		>
			<Nav
				class="lg:px-12"
				should-invert-icon-color
				:should-wrap-in-container="false"
			/>

			<div
				id="hero-content"
				class="absolute left-1/2 top-1/2 mt-5 w-full -translate-x-1/2 -translate-y-1/2 px-4 text-center"
			>
				<h1
					class="font-means-web text-4xl font-bold !leading-[1.175] sm:text-5xl lg:text-6xl 2xl:text-7xl"
				>
					What are you going to read today?
				</h1>
			</div>
		</div>

		<div
			class="space-y-12 py-10 text-skin-primary sm:space-y-10 lg:space-y-14 lg:py-16"
		>
			<IndexBooksRow section-title="Top rated">
				<swiper-slide
					v-for="index in Array.from({ length: 20 }, (x, i) => i)"
					:key="index"
				>
					<IndexBookCard :book="book" />
				</swiper-slide>
			</IndexBooksRow>

			<IndexBooksRow section-title="Dystopias">
				<swiper-slide
					v-for="index in Array.from({ length: 4 }, (x, i) => i)"
					:key="index"
				>
					<IndexBookCard :book="book" />
				</swiper-slide>
			</IndexBooksRow>

			<IndexBooksRow section-title="Cult classic">
				<swiper-slide
					v-for="index in Array.from({ length: 10 }, (x, i) => i)"
					:key="index"
				>
					<IndexBookCard :book="book" />
				</swiper-slide>
			</IndexBooksRow>
		</div>

		<Footer class="border-t-4 border-skin-border !bg-transparent" />
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
