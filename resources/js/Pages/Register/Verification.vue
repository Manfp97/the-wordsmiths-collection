<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import VerificationCodeInput from "@/Components/Register/Verification/VerificationCodeInput.vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";

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
		:header-title="'Verify your email address'"
		:subscription-plan="subscriptionPlan"
		:current-step="2"
	>
		<p>
			We emailed you a six-digit code to <strong>name@company.com</strong>.
			Enter the code below to confirm your email address.
		</p>

		<form
			class="space-y-6"
			action="#"
		>
			<div class="flex justify-center my-4 md:my-6 space-x-2 sm:space-x-4">
				<VerificationCodeInput 
					v-for="item in [1, 2, 3, 4, 5, 6]" 
					:key="item"
					:index="item"
				/>
			</div>

			<p
				class="p-4 text-sm rounded-lg mb-4 md:mb-6 bg-skin-primary-offset text-skin-text-muted"
			>
				Make sure to keep this window open while check your inbox.
			</p>

			<Link
				href="/register/payment#form"
				class="hover:bg-skin-secondary-offset my-2 flex items-center justify-center rounded-md bg-skin-secondary py-3 font-bold"
			>
				Verify account
			</Link>
		</form>
	</RegisterLayout>
</template>
