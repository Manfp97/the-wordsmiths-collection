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
		<div class="mb-4 grid gap-4 sm:grid-cols-2">
			<FloatingLabel
				:id="'category-name'"
				v-model:value="form.name"
				label-text="Name"
				:type="'text'"
				:autocomplete="'off'"
				:error-message="form.errors.name"
			/>
		</div>

		<button
			type="submit"
			class="inline-flex items-center rounded-lg !bg-skin-secondary px-5 py-2.5 text-center text-sm font-bold hover:!bg-skin-secondary-offset focus:outline-none"
			:disabled="form.processing"
		>
			<IconPlus
				class="-ml-1 mr-1 h-6 w-6"
				fill="currentColor"
			/>
			Add new category
		</button>
	</form>
</template>
