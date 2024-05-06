<script setup>
import { trans } from "laravel-vue-i18n";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import Logo from "@/Components/Common/Logo.vue";
import Footer from "@/Components/Common/Footer.vue";
import FormPasswordForgot from "@/Forms/FormPasswordForgot.vue";

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
		:title="trans('page.auth.forgot_password.title')"
		:description="trans('page.auth.forgot_password.description')"
	/>

	<BaseLayout>
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
					<h5
						class="mb-8 text-center font-means-web text-3xl font-bold sm:mb-12"
					>
						{{ trans("page.auth.forgot_password.title") }}
					</h5>

					<div
						v-if="status"
						class="mb-4 text-sm font-medium text-skin-success"
					>
						{{ status }}
					</div>

					<div class="mb-4 text-sm text-skin-muted">
						{{ trans("page.auth.forgot_password.message") }}
					</div>

					<FormPasswordForgot :can-reset-password="canResetPassword" />
				</section>
			</div>

			<Footer />
		</div>
	</BaseLayout>
</template>
