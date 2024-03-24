<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import Logo from "@/Components/Common/Logo.vue";
import Footer from "@/Components/Common/Footer.vue";
import FormForgotPassword from "@/Forms/FormForgotPassword.vue";

defineProps({
	status: {
		type: String,
		required: false,
		default: null,
	},
});
</script>

<template>
	<AppHead
		title="Forgot Password"
		description="Recover your The Wordsmith's Collection account password"
	/>

	<!-- TODO: Same structure as Login -->
	<div class="flex min-h-screen flex-col">
		<div
			class="flex min-h-full flex-1 flex-col items-center justify-center bg-skin-primary"
		>
			<Logo
				class="mx-4 mt-16 2xl:mt-10"
				size="md"
			/>

			<section
				class="mx-4 mb-24 mt-10 max-w-lg rounded-lg border bg-skin-white p-6 shadow sm:w-full sm:p-8"
			>
				<h5 class="mb-8 text-center font-means-web text-3xl font-bold sm:mb-12">
					Forgot password
				</h5>

				<!-- Auth/Login en proyecto breeze. No sé qué hace -->
				<div
					v-if="status"
					class="mb-4 text-sm font-medium text-skin-success"
				>
					{{ status }}
				</div>
				<!--  -->

				<div class="mb-4 text-sm text-skin-muted">
					Forgot your password? No problem. Just let us know your email address
					and we will email you a password reset link that will allow you to
					choose a new one.
				</div>

				<FormForgotPassword :can-reset-password="canResetPassword" />
			</section>
		</div>

		<Footer />
	</div>
</template>
