<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import Logo from "@/Components/Common/Logo.vue";
import Footer from "@/Components/Common/Footer.vue";
import FormPasswordReset from "@/Forms/FormPasswordReset.vue";

defineProps({
	email: {
		type: String,
		required: true,
	},
	token: {
		type: String,
		required: true,
	},
});
</script>

<template>
	<AppHead title="Reset password" />

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
					Reset your password
				</h5>

				<div
					v-if="status"
					class="mb-4 text-sm font-medium text-skin-success"
				>
					{{ status }}
				</div>

				<FormPasswordReset
					form-id="form-password-reset"
					:email="email"
					:token="token"
				/>
			</section>
		</div>

		<Footer />
	</div>
</template>
