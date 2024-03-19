<script setup>
import SwiperContainer from "@/Components/Swiper/SwiperContainer.vue";

defineProps({
	breakpoints: {
		type: Object,
		required: true,
	},
	navigation: {
		type: Object,
		required: false,
		default: null,
	},
});
</script>

<template>
	<section class="mx-auto w-full overflow-hidden">
		<slot name="header" />

		<SwiperContainer
			:breakpoints="breakpoints"
			:navigation="navigation"
		>
			<slot />
		</SwiperContainer>
	</section>
</template>
