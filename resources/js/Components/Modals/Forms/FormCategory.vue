<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";

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
			<svg
				class="-ml-1 mr-1 h-6 w-6"
				fill="currentColor"
				viewBox="0 0 20 20"
				xmlns="http://www.w3.org/2000/svg"
			>
				<path
					fill-rule="evenodd"
					d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
					clip-rule="evenodd"
				/>
			</svg>
			Add new category
		</button>
	</form>
</template>
