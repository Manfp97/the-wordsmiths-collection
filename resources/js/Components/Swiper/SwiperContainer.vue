<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
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

const navigationValue = props.navigation ?? true;
const $swiperContainer = ref(null);

onMounted(() => {
	// swiper parameters
	const params = {
		navigation: navigationValue,
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
	};

	Object.assign($swiperContainer.value, params);
	$swiperContainer.value.initialize();
});
</script>

<template>
	<swiper-container
		ref="$swiperContainer"
		init="false"
		:breakpoints="breakpoints"
	>
		<slot />
	</swiper-container>
</template>
