<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import Footer from "@/Components/Common/Footer.vue";
</script>

<template>
	<slot name="appHead">
		<AppHead />
	</slot>

	<slot name="nav">
		<Nav />
	</slot>

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
			<slot name="main" />
		</main>

		<Footer />
	</div>

	<slot name="modals" />
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

:deep(.index-title) {
	@apply text-xl md:text-2xl 2xl:text-3xl;
}
</style>
