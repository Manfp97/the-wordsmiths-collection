<script setup>
import { trans } from "laravel-vue-i18n";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import Logo from "@/Components/Common/Logo.vue";
import Footer from "@/Components/Common/Footer.vue";
import FormLogin from "@/Forms/FormLogin.vue";

defineProps({
	canResetPassword: {
		type: Boolean,
		required: false,
		default: true,
	},
	status: {
		type: String,
		required: false,
		default: null,
	},
});
</script>

<template>
	<AppHead
		:title="trans('common.action.log_in')"
		:description="trans('page.page.auth.log_in.description')"
	/>

	<BaseLayout>
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
						{{ trans("common.action.log_in") }}
					</h5>

					<div
						v-if="status"
						class="mb-4 text-sm font-medium text-skin-success"
					>
						{{ status }}
					</div>

					<FormLogin :can-reset-password="canResetPassword" />
				</section>
			</div>

			<Footer />
		</div>
	</BaseLayout>
</template>
