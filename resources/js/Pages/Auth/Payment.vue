<script setup>
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import FormPayment from "@/Forms/FormPayment.vue";

defineProps({
	selectedSubscriptionPlan: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<AppHead
		title="Payment"
		description="Complete the payment to The Wordsmith's Collection to start reading a vast library of the greatest works of literature."
	/>

	<RegisterLayout
		header-title="Secure payment info"
		:subscription-plan="selectedSubscriptionPlan"
		:current-step="3"
	>
		<FormPayment
			form-id="form-registration-payment-method"
			http-method="post"
		>
			<template #subscriptionPlan>
				<div
					class="flex items-center justify-between rounded-lg bg-skin-white bg-opacity-60 px-4 py-3"
				>
					<div>
						<p class="font-bold">
							{{ selectedSubscriptionPlan.price }}
							{{ selectedSubscriptionPlan.currency }}
							<span class="text-xs">/month</span>
						</p>
						<p class="text-skin-muted">
							{{ selectedSubscriptionPlan.name }}
						</p>
					</div>

					<Link
						class="font-bold text-skin-link"
						href="/subscribe"
					>
						Change
					</Link>
				</div>

				<p class="mx-auto max-w-xl text-sm text-skin-muted">
					By clicking the "Start paid membership" button below, you agree to our
					Terms of Use and that you are over 18 and acknowledge the Privacy
					Statement. The Wordsmith's Collection will automatically continue your
					membership and charge the membership fee (currently
					{{ selectedSubscriptionPlan.price }}
					{{ selectedSubscriptionPlan.currency }}
					/month) to your payment method until you cancel. You may cancel at any
					time to avoid future charges.
				</p>
			</template>
		</FormPayment>
	</RegisterLayout>
</template>
