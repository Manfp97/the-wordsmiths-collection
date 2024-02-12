<script setup>
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import FormPayment from "@/Forms/FormPayment.vue";

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
		description="Complete the payment to The Wordsmith's Collection to start reading a vast library of the greatest works of literature."
	/>

	<RegisterLayout
		header-title="Secure payment info"
		:subscription-plan="subscriptionPlan"
		:current-step="3"
	>
		<FormPayment
			:subscription-plan-name="subscriptionPlan.name"
			:subscription-price="`${subscriptionPlan.currency}${subscriptionPlan.price}`"
		/>
	</RegisterLayout>
</template>
