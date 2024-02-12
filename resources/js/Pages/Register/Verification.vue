<script setup>
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import FormVerification from "@/Forms/FormVerification.vue";

const subscriptionPlan = {
	name: "Basic",
	price: 4.99,
	currency: "€",
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
		title="Payment"
		description="Verify your The Wordsmith's Collection account to start reading a vast library of the greatest works of literature."
	/>

	<RegisterLayout
		:header-title="'Verify your email address'"
		:subscription-plan="subscriptionPlan"
		:current-step="2"
	>
		<p>
			We emailed you a six-digit code to <strong>name@company.com</strong>.
			Enter the code below to confirm your email address.
		</p>

		<FormVerification />
	</RegisterLayout>
</template>
