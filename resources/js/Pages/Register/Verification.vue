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

		<form
			class="space-y-6"
			action="#"
		>
			<div class="my-4 flex justify-center space-x-2 sm:space-x-4 md:my-6">
				<VerificationCodeInput
					v-for="item in [1, 2, 3, 4, 5, 6]"
					:key="item"
					:index="item"
				/>
			</div>

			<p
				class="mb-4 rounded-lg bg-skin-primary-offset p-4 text-sm text-skin-text-muted md:mb-6"
			>
				Make sure to keep this window open while check your inbox.
			</p>

			<Link
				href="/register/payment#form"
				class="my-2 flex items-center justify-center rounded-md bg-skin-secondary py-3 font-bold hover:bg-skin-secondary-offset"
			>
				Verify account
			</Link>
		</form>
	</RegisterLayout>
</template>
