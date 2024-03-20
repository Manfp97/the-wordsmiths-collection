<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import SectionDeleteUser from "./Partials/SectionDeleteUser.vue";
import SectionUpdatePassword from "./Partials/SectionUpdatePassword.vue";
import SectionUpdateProfileInformation from "./Partials/SectionUpdateProfileInformation.vue";
import SectionCreditCardDetails from "./Partials/SectionCreditCardDetails.vue";
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
	creditCard: {
		type: Object,
		required: false,
		default: null,
	},
});
</script>

<template>
	<AppHead title="Profile" />

	<Nav />

	<div class="page-container">
		<main class="container">
			<header class="mx-auto pt-12 text-center">
				<h2 class="section-title underline">Profile</h2>
			</header>

			<div class="mx-auto max-w-3xl py-12">
				<div class="mx-auto space-y-6 sm:px-6 lg:px-8">
					<div class="section-container">
						<SectionUpdateProfileInformation
							:must-verify-email="mustVerifyEmail"
							:status="status"
						/>
					</div>

					<div class="section-container">
						<SectionUpdatePassword />
					</div>

					<div
						v-if="creditCard"
						class="section-container"
					>
						<SectionCreditCardDetails :credit-card="creditCard" />
					</div>
					<div class="section-container">
						<SectionDeleteUser />
					</div>
				</div>
			</div>
		</main>

		<Footer />
	</div>
</template>

<style scoped>
.section-container {
	@apply bg-skin-white p-4 shadow sm:rounded-lg sm:p-8;
}
</style>
