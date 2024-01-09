<script setup>
import { register } from "swiper/element/bundle";
import { ref, onMounted } from "vue";

defineProps({
	sectionTitle: {
		type: String,
		required: true,
	},
});

register();

const swiperRef = ref(null);

const params = {
	injectStyles: [
		`
		.swiper-horizontal {
			overflow: visible;
			width: 94%;
			margin-left: auto;
			margin-right: auto
		}

		.swiper-button-next, 
		.swiper-button-prev {
      color: #e9c46a;
    }

		.swiper-button-disabled {
			display: none;   
		}

		@media (min-width: 1024px) {
			.swiper-horizontal {
				width: 90%;
			}

			.swiper-button-prev {
				left: -50px;
			}

			.swiper-button-next {
				right: -50px;
			}
		}

		@media (min-width: 1536px) {
			.swiper-horizontal {
				width: 95%;
			}

			.swiper-button-prev svg,
			.swiper-button-next svg {
				height: 100%;
				width: 50%;
			}

			.swiper-button-prev {
				left: -45px;
			}

			.swiper-button-next {
				right: -45px;
			}
		}

		@media (min-width: 1885px) {
			.swiper-button-prev svg,
			.swiper-button-next svg {
				height: 75%;
				width: 75%;
			}

			.swiper-button-prev {
				left: -50px;
			}

			.swiper-button-next {
				right: -50px;
			}
		}

		@media (max-width: 1023px) {
			.swiper-button-next, 
			.swiper-button-prev {
				display: none;
			}
		}
		`,
	],
	navigation: true,
};

onMounted(() => {
	Object.assign(swiperRef.value, params);
	swiperRef.value.initialize();
});
</script>

<template>
	<section class="mx-auto w-full overflow-hidden">
		<h2
			class="mb-6 px-4 text-xl font-bold md:px-6 md:text-2xl lg:px-16 xl:text-3xl"
		>
			{{ sectionTitle }}
		</h2>
		<swiper-container
			ref="swiperRef"
			init="false"
			:navigation="true"
			:breakpoints="{
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
			}"
		>
			<slot />
		</swiper-container>
	</section>
</template>
