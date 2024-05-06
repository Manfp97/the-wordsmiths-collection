<script setup>
import { trans } from "laravel-vue-i18n";
import AppHead from "@/Components/Common/AppHead.vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import FormRegister from "@/Forms/FormRegister.vue";

defineProps({
	selectedSubscriptionPlan: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<AppHead
		:title="trans('page.auth.register.title')"
		:description="trans('page.auth.register.description')"
	/>

	<RegisterLayout
		:header-title="trans('page.auth.register.header_title')"
		:subscription-plan="selectedSubscriptionPlan"
		:current-step="1"
	>
		<FormRegister />
	</RegisterLayout>
</template>
