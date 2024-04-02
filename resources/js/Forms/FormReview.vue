<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch } from "vue";
import FloatingTextarea from "@/Components/Forms/FloatingTextarea.vue";
import Rating from "@/Components/Common/Rating.vue";

const emit = defineEmits(["success"]);

const props = defineProps({
	bookId: {
		type: Number,
		required: true,
	},
	review: {
		type: Object,
		required: false,
		default: null,
	},
	httpMethod: {
		type: String,
		required: true,
	},
});

const form = useForm({
	review_text: props.review?.review_text,
	rating: props.review?.rating,
});

watch(
	() => props.review,
	(newValue) => {
		form.review_text = newValue?.review_text;
		form.rating = newValue?.rating;
	}
);

const submitForm = () => {
	const url =
		props.httpMethod === "post"
			? `/review/${props.bookId}`
			: `/review/${props.review.id}`;

	form[props.httpMethod](url, {
		preserveScroll: true,
		preserveState: "errors",
		onSuccess: () => {
			form.reset();
			form.clearErrors();
			emit("success");
		},
	});
};
</script>

<template>
	<form
		class="space-y-6"
		@submit.prevent="submitForm"
	>
		<FloatingTextarea
			v-model:value="form.review_text"
			textarea-id="review-textarea"
			label-text="Review"
			textarea-class="min-h-[10rem]"
		/>

		<div
			v-if="form.errors"
			class="text-skin-danger"
		>
			<span v-if="form.errors.book_id">The book ID is not valid.</span>
			<span v-if="form.errors.rating">{{ form.errors.rating }}</span>
		</div>

		<div class="flex items-center justify-between">
			<div class="flex space-x-3">
				<span class="font-bold">Rating</span>
				<Rating
					v-model:value="form.rating"
					:rating="form.rating ?? 0"
					icon-class="w-5 h-5"
				/>
			</div>

			<button
				type="submit"
				class="button px-5 py-2.5 text-sm font-bold"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				Submit
			</button>
		</div>
	</form>
</template>
