<script setup>
import { computed } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";

const props = defineProps({
	status: {
		type: String,
		required: false,
		default: null,
	},
	selectedSubscriptionPlan: {
		type: Object,
		required: true,
	},
});

const form = useForm({});

const submit = () => {
	form.post("/email/verification-notification");
};

const verificationLinkSent = computed(
	() => props.status === "verification-link-sent"
);
</script>

<template>
	<AppHead
		:title="trans('page.auth.verify_email.title')"
		:description="trans('page.auth.verify_email.description')"
	/>

	<RegisterLayout
		:header-title="trans('page.auth.verify_email.header_title')"
		:subscription-plan="selectedSubscriptionPlan"
		:current-step="2"
	>
		<!-- eslint-disable vue/no-v-html -->
		<p
			v-html="
				trans('page.auth.verify_email.message', {
					email: usePage().props.auth.user.email,
				})
			"
		/>
		<!-- eslint-enable -->

		<div
			v-if="verificationLinkSent"
			class="mt-4 font-medium text-skin-success"
		>
			{{ trans("page.auth.verify_email.link_sent") }}
		</div>

		<form @submit.prevent="submit">
			<div class="mt-4 grid grid-cols-3 items-center justify-between">
				<button
					class="button col-span-2"
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
				>
					{{ trans("page.auth.verify_email.button") }}
				</button>

				<Link
					href="/logout"
					method="post"
					as="button"
					class="text-skin-danger underline hover:text-skin-danger-light"
				>
					{{ trans("common.action.log_out") }}
				</Link>
			</div>
		</form>
	</RegisterLayout>
</template>
