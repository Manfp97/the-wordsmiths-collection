<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import IconPlus from "@icons/plus.svg?component";

const form = useForm({
	name: null,
});

const submitForm = () => {
	form.post("/category", {
		onSuccess: () => {
			form.reset();
			form.clearErrors();
		},
	});
};
</script>

<template>
	<form @submit.prevent="submitForm">
		<FloatingLabel
			v-model:value="form.name"
			input-id="category-name"
			label-text="Name"
			input-type="text"
			input-autocomplete="off"
			:error-message="form.errors.name"
		/>

		<div class="mt-6 flex justify-end">
			<button
				type="submit"
				class="button text-sm font-bold"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				<IconPlus
					class="-ml-1 mr-1 h-6 w-6"
					fill="currentColor"
				/>
				Add new category
			</button>
		</div>
	</form>
</template>
