<script setup>
import { trans } from "laravel-vue-i18n";
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
		:title="trans('page.auth.payment.title')"
		:description="trans('page.auth.payment.description')"
	/>

	<RegisterLayout
		:header-title="trans('page.auth.payment.header_title')"
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
						{{ trans("common.action.change") }}
					</Link>
				</div>

				<p class="mx-auto max-w-xl text-sm text-skin-muted">
					{{
						trans("page.auth.payment.message", {
							price: selectedSubscriptionPlan.price,
							currency: selectedSubscriptionPlan.currency,
						})
					}}
				</p>
			</template>
		</FormPayment>
	</RegisterLayout>
</template>
