<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import FormAccount from "@/Forms/FormAccount.vue";

const subscriptionPlan = {
	name: "Basic",
	features: [
		{
			isCheck: true,
			text: "Write reviews",
		},
		{
			isCheck: true,
			text: "Read <span class='font-bold'>Basic</span> books",
		},
	],
};
</script>

<template>
	<AppHead
		title="Account"
		description="Create your account to continue with the registration process for The Wordsmith's Collection."
	/>

	<RegisterLayout
		header-title="Account details"
		:subscription-plan="subscriptionPlan"
		:current-step="1"
	>
		<FormAccount />
	</RegisterLayout>
</template>
