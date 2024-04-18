<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";

const props = defineProps({
	formId: {
		type: String,
		required: true,
	},
	email: {
		type: String,
		required: true,
	},
	token: {
		type: String,
		required: true,
	},
});

const form = useForm({
	token: props.token,
	email: props.email,
	password: "",
	password_confirmation: "",
});

const submitForm = () => {
	form.post("/reset-password", {
		onFinish: () => form.reset("password", "password_confirmation"),
	});
};
</script>

<template>
	<form
		:id="formId"
		class="space-y-6"
		@submit.prevent="submitForm"
	>
		<FloatingLabel
			v-model:value="form.email"
			:input-id="`${formId}-email`"
			label-text="Email"
			input-type="email"
			input-autocomplete="username"
			is-required
			:error-message="form.errors.email"
		/>

		<FloatingLabel
			v-model:value="form.password"
			:input-id="`${formId}-password`"
			label-text="Password"
			input-type="password"
			input-autocomplete="new-password"
			is-required
			:error-message="form.errors.password"
		/>

		<FloatingLabel
			v-model:value="form.password_confirmation"
			:input-id="`${formId}-password-confirmation`"
			label-text="Password confirmation"
			input-type="password"
			input-autocomplete="new-password"
			is-required
			:error-message="form.errors.password_confirmation"
		/>

		<div class="mt-4 flex items-center justify-end">
			<button
				type="submit"
				class="button text-sm font-bold"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				Reset password
			</button>
		</div>
	</form>
</template>
