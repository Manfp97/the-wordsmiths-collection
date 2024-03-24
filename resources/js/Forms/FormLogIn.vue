<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";

defineProps({
	canResetPassword: {
		type: Boolean,
		required: false,
		default: true,
	},
});

const form = useForm({
	email: null,
	password: null,
	remember: false,
});

const submitForm = () => {
	form.post("/login", {
		onFinish: () => form.reset("password"),
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
		<FloatingLabel
			v-model:value="form.email"
			input-id="email"
			label-text="Your email"
			input-type="email"
			input-autocomplete="email"
			input-required
			:error-message="form.errors.email"
		/>
		<FloatingLabel
			v-model:value="form.password"
			input-id="password"
			label-text="Your password"
			input-type="password"
			input-autocomplete="current-password"
			input-required
			:error-message="form.errors.password"
		/>

		<div class="flex items-start">
			<Checkbox
				v-model:value="form.remember"
				input-id="remember"
			>
				Remember me
			</Checkbox>

			<Link
				v-if="canResetPassword"
				href="/forgot-password"
				class="ms-auto text-sm text-skin-link underline hover:text-skin-text"
			>
				Forgot password?
			</Link>
		</div>

		<button
			type="submit"
			class="w-full rounded-lg !bg-skin-secondary px-5 py-2.5 text-center text-sm font-bold hover:!bg-skin-secondary-offset focus:outline-none focus:ring-4 focus:ring-skin-border"
			:class="{ 'opacity-25': form.processing }"
			:disabled="form.processing"
		>
			Log in to your account
		</button>

		<div class="text-center text-sm font-medium text-skin-muted">
			Not registered?
			<Link
				href="/pricing"
				class="text-skin-link underline hover:text-skin-text"
				>Select a subscription plan</Link
			>
			to create your account
		</div>
	</form>
</template>
