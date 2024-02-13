<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingTextarea from "@/Components/Forms/FloatingTextarea.vue";
import Rating from "@/Components/Common/Rating.vue";

const form = useForm({
	text: null,
	rating: null,
});

const submitForm = () => {
	form.post("/review", {
		onSuccess: () => {
			form.reset();
			form.clearErrors();
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
			v-model:value="form.text"
			textarea-id="review-textarea"
			label-text="Review"
			textarea-class="min-h-[10rem]"
		/>

		<div class="flex items-center justify-between">
			<div class="flex space-x-3">
				<span class="font-bold">Rating</span>
				<Rating
					:rating="0"
					icon-class="w-5 h-5"
				/>
			</div>

			<button
				type="submit"
				class="button px-5 py-2.5 text-sm font-bold"
				:disabled="form.processing"
			>
				Submit
			</button>
		</div>
	</form>
</template>
