<script setup>
import { trans } from "laravel-vue-i18n";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import SectionUserDelete from "./Partials/SectionUserDelete.vue";
import SectionPasswordUpdate from "./Partials/SectionPasswordUpdate.vue";
import SectionProfileInformationUpdate from "./Partials/SectionProfileInformationUpdate.vue";
import SectionSubscriptionDetails from "./Partials/SectionSubscriptionDetails.vue";
import SectionCreditCardDetails from "./Partials/SectionCreditCardDetails.vue";
import SectionGoToPayment from "./Partials/SectionGoToPayment.vue";
import Footer from "@/Components/Common/Footer.vue";

defineProps({
	mustVerifyEmail: {
		type: Boolean,
		required: false,
		default: false,
	},
	status: {
		type: String,
		required: false,
		default: null,
	},
	subscription: {
		type: Object,
		required: false,
		default: null,
	},
	otherSubscriptionPlan: {
		type: Object,
		required: false,
		default: null,
	},
	creditCard: {
		type: Object,
		required: false,
		default: null,
	},
});
</script>

<template>
	<AppHead :title="trans('common.noun.profile')" />

	<BaseLayout>
		<Nav />

		<div class="page-container">
			<main class="container">
				<header class="mx-auto pt-12 text-center">
					<h2 class="section-title underline">
						{{ trans("common.noun.profile") }}
					</h2>
				</header>

				<div class="mx-auto max-w-3xl py-12">
					<div class="mx-auto space-y-6 sm:px-6 lg:px-8">
						<div class="section-container">
							<SectionProfileInformationUpdate
								:must-verify-email="mustVerifyEmail"
								:status="status"
							/>
						</div>

						<div class="section-container">
							<SectionPasswordUpdate />
						</div>

						<div
							v-if="subscription"
							class="section-container"
						>
							<SectionSubscriptionDetails
								:subscription="subscription"
								:other-subscription-plan="otherSubscriptionPlan"
							/>
						</div>

						<div
							v-if="creditCard"
							class="section-container"
						>
							<SectionCreditCardDetails :credit-card="creditCard" />
						</div>

						<div
							v-if="!creditCard && !subscription"
							class="section-container"
						>
							<SectionGoToPayment />
						</div>

						<div class="section-container">
							<SectionUserDelete />
						</div>
					</div>
				</div>
			</main>

			<Footer />
		</div>
	</BaseLayout>
</template>

<style scoped>
.section-container {
	@apply bg-skin-white p-4 shadow sm:rounded-lg sm:p-8;
}
</style>
