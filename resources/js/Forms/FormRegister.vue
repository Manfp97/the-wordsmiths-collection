<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";
import IconRightArrow from "@icons/right-arrow.svg?component";

const form = useForm({
	username: null,
	email: null,
	password: null,
	password_confirmation: null,
});

const submitForm = () => {
	form.post("/register", {
		onFinish: () => form.reset("password", "password_confirmation"),
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
			v-model:value="form.username"
			input-id="username"
			label-text="Your username"
			input-type="text"
			input-autocomplete="off"
			input-required
			:error-message="form.errors.username"
		/>
		<FloatingLabel
			v-model:value="form.email"
			input-id="email"
			label-text="Your email"
			input-type="email"
			input-autocomplete="off"
			input-required
			:error-message="form.errors.email"
		/>
		<FloatingLabel
			v-model:value="form.password"
			input-id="password"
			label-text="Your password"
			input-type="password"
			input-autocomplete="new-password"
			input-required
			:error-message="form.errors.password"
		/>
		<FloatingLabel
			v-model:value="form.password_confirmation"
			input-id="password_confirmation"
			label-text="Confirm your password"
			input-type="password"
			input-autocomplete="new-password"
			input-required
			:error-message="form.errors.password_confirmation"
		/>

		<Checkbox
			input-id="accept-terms"
			is-required
		>
			I agree to the
			<Link
				class="text-skin-link underline hover:text-skin-text"
				href="/terms"
			>
				Terms and Conditions
			</Link>
		</Checkbox>

		<button
			type="submit"
			class="button"
			:class="{ 'opacity-25': form.processing }"
			:disabled="form.processing"
		>
			Continue
			<IconRightArrow
				class="ml-4 h-4 w-4"
				fill="none"
				stroke="currentColor"
				stroke-width="2"
			/>
		</button>

		<p class="text-center text-sm text-skin-text-muted">
			Already have an account?
			<Link
				href="/login"
				class="text-skin-link underline hover:text-skin-text"
			>
				Login here
			</Link>
		</p>
	</form>
</template>
