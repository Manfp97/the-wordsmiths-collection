<script setup>
import { ref, watch } from "vue";
import IconStar from "@icons/star.svg?component";

const valueModel = defineModel("value"); // eslint-disable-line

const props = defineProps({
	stars: {
		type: Number,
		required: false,
		default: 5,
	},
	rating: {
		type: Number,
		required: true,
	},
	iconClass: {
		type: String,
		required: false,
		default: null,
	},
	editable: {
		type: Boolean,
		default: true,
	},
});

const currentRating = ref(valueModel.value ?? props.rating);

const hoverRating = (starCount) => {
	currentRating.value = starCount;
};

const setRating = (starCount) => {
	currentRating.value = starCount;
	valueModel.value = starCount;
};

const resetRating = () => {
	currentRating.value = valueModel.value ?? props.rating;
};

// Watch for changes in props.rating and update currentRating accordingly
watch(
	() => props.rating,
	(newValue) => {
		currentRating.value = newValue;
	}
);
</script>

<template>
	<div
		class="flex items-center space-x-1 rtl:space-x-reverse"
		@mouseleave="editable && resetRating()"
	>
		<IconStar
			v-for="(star, index) in stars"
			:key="index"
			:class="{
				[iconClass]: !!iconClass,
				'text-skin-secondary': index < currentRating,
				'text-skin-border': index >= currentRating,
				'cursor-pointer': editable,
			}"
			aria-hidden="true"
			fill="currentColor"
			@mouseover="editable && hoverRating(index + 1)"
			@click="editable && setRating(index + 1)"
		/>
	</div>
</template>
