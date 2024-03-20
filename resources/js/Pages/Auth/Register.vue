<script setup>
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
		title="Account"
		description="Create your account to continue with the registration process for The Wordsmith's Collection."
	/>

	<RegisterLayout
		header-title="Account details"
		:subscription-plan="selectedSubscriptionPlan"
		:current-step="1"
	>
		<FormRegister />
	</RegisterLayout>
</template>
