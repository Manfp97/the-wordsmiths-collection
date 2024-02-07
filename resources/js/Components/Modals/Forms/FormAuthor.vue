<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import IconPlus from "@icons/plus.svg?component";

const form = useForm({
	first_name: null,
	last_name: null,
});

const submitForm = () => {
	form.post("/author", {
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
				:id="'author-first-name'"
				v-model:value="form.first_name"
				label-text="First name"
				:type="'text'"
				:autocomplete="'off'"
				:error-message="form.errors.first_name"
			/>
			<FloatingLabel
				:id="'author-last-name'"
				v-model:value="form.last_name"
				label-text="Last name"
				:type="'text'"
				:autocomplete="'off'"
				:error-message="form.errors.last_name"
			/>
		</div>

		<button
			type="submit"
			class="hover:bg-primary-800 focus:ring-primary-300 inline-flex items-center rounded-lg !bg-skin-secondary px-5 py-2.5 text-center text-sm font-bold focus:outline-none"
			:disabled="form.processing"
		>
			<IconPlus
				class="-ml-1 mr-1 h-6 w-6"
				fill="currentColor"
			/>
			Add new author
		</button>
	</form>
</template>
