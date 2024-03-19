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
		<FormPayment>
			<template #subscriptionPlan>
				<div
					class="flex items-center justify-between rounded-lg bg-skin-white bg-opacity-60 px-4 py-3"
				>
					<div>
						<p class="font-bold">
							{{ subscriptionPrice }}<span class="text-xs">/month</span>
						</p>
						<p class="text-skin-text-muted">{{ subscriptionPlanName }}</p>
					</div>

					<Link
						class="font-bold text-skin-link"
						href="/pricing"
					>
						Change
					</Link>
				</div>

				<p class="mx-auto max-w-xl text-sm text-skin-text-muted">
					By clicking the "Start paid membership" button below, you agree to our
					Terms of Use and that you are over 18 and acknowledge the Privacy
					Statement. The Wordsmith's Collection will automatically continue your
					membership and charge the membership fee (currently
					{{ subscriptionPrice }}/month) to your payment method until you
					cancel. You may cancel at any time to avoid future charges.
				</p>
			</template>
		</FormPayment>
	</RegisterLayout>
</template>
