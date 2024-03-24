<script>
export const navigation = {
	nextEl: ".swiper-right",
	prevEl: ".swiper-left",
};
</script>

<script setup>
import CaretLeft from "@icons/caret-left.svg?component";
import CaretRight from "@icons/caret-right.svg?component";

defineProps({
	buttonsClass: {
		type: String,
		required: false,
		default: "h-6 w-6",
	},
});
</script>

<template>
	<div class="mr-2 inline-flex justify-center space-x-2">
		<CaretLeft
			class="swiper-left common"
			:class="buttonsClass"
		/>
		<CaretRight
			class="swiper-right common"
			:class="buttonsClass"
		/>
	</div>
</template>

<style scoped>
.common {
	@apply cursor-pointer hover:fill-skin-secondary;
}

:deep(.swiper-button-disabled) {
	@apply cursor-default fill-skin-muted hover:fill-skin-muted;
}
</style>
