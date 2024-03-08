<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";

const form = useForm({
	email: null,
	password: null,
});

const submitForm = () => {
	form.post("/login", {
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
		<h5 class="mb-8 text-center font-means-web text-3xl font-bold sm:mb-12">
			Log in to your account
		</h5>

		<FloatingLabel
			v-model:value="form.email"
			input-id="email"
			label-text="Your email or username"
			input-type="email"
			input-autocomplete="email"
			:error-message="form.errors.email"
		/>
		<FloatingLabel
			v-model:value="form.password"
			input-id="password"
			label-text="Your password"
			input-type="password"
			input-autocomplete="password"
			:error-message="form.errors.password"
		/>

		<div class="flex items-start">
			<div class="flex items-start">
				<div class="flex h-5 items-center">
					<input
						id="remember"
						type="checkbox"
						value=""
						class="focus:ring-3 h-4 w-4 cursor-pointer rounded border border-skin-border focus:ring-skin-secondary"
						required
					/>
				</div>
				<label
					for="remember"
					class="ms-2 text-sm font-medium"
				>
					Remember me
				</label>
			</div>
			<a
				href="#"
				class="ms-auto hidden text-sm text-skin-link hover:underline"
			>
				Forgot password?
			</a>
		</div>

		<button
			type="submit"
			class="w-full rounded-lg !bg-skin-secondary px-5 py-2.5 text-center text-sm font-bold hover:!bg-skin-secondary-offset focus:outline-none focus:ring-4 focus:ring-skin-border"
			:class="{ 'opacity-25': form.processing }"
			:disabled="form.processing"
		>
			Log in to your account
		</button>

		<div class="text-center text-sm font-medium text-skin-text-muted">
			Not registered?
			<Link
				href="/pricing"
				class="text-skin-link hover:underline"
			>
				Select a subscription plan
			</Link>
			to create your account
		</div>
	</form>
</template>
