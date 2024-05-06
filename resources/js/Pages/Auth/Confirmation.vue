<script setup>
import { trans } from "laravel-vue-i18n";
import AppHead from "@/Components/Common/AppHead.vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import IconCheckCircleFilled from "@icons/check-circle-filled.svg?component";

defineProps({
	selectedSubscriptionPlan: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<AppHead
		:title="trans('page.auth.confirmation.title')"
		:description="trans('page.auth.confirmation.description')"
	/>

	<RegisterLayout
		:header-title="trans('page.auth.confirmation.header_title')"
		:subscription-plan="selectedSubscriptionPlan"
		:should-show-change-plan="false"
		:current-step="4"
	>
		<div class="mb-6 w-full text-center">
			<IconCheckCircleFilled class="mx-auto mb-4 h-12 w-12" />

			<p>{{ trans("page.auth.confirmation.message") }}</p>
			<p>{{ trans("page.auth.confirmation.start_reading_now") }}</p>
		</div>
		<Link
			href="/"
			class="button"
		>
			{{ trans("page.auth.confirmation.go_to_home") }}
		</Link>
	</RegisterLayout>
</template>
