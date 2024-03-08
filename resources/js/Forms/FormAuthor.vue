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
		<div class="grid gap-4 sm:grid-cols-2">
			<FloatingLabel
				v-model:value="form.first_name"
				input-id="author-first-name"
				label-text="First name"
				input-type="text"
				input-autocomplete="off"
				:error-message="form.errors.first_name"
			/>
			<FloatingLabel
				v-model:value="form.last_name"
				input-id="author-last-name"
				label-text="Last name"
				input-type="text"
				input-autocomplete="off"
				:error-message="form.errors.last_name"
			/>
		</div>

		<div class="mt-6 flex justify-center">
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
				Add new author
			</button>
		</div>
	</form>
</template>
