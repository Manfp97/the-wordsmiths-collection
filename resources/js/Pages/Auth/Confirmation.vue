<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import IconCheckCircleFilled from "@icons/check-circle-filled.svg?component";

defineProps({
	selectedSubscriptionPlan: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<AppHead
		title="Confirmation"
		description="Congratulations! Your The Wordsmith's Collection account has been successfully created. Start reading now!"
	/>

	<RegisterLayout
		header-title="Registration completed"
		:subscription-plan="selectedSubscriptionPlan"
		:should-show-change-plan="false"
		:current-step="4"
	>
		<div class="mb-6 w-full text-center">
			<IconCheckCircleFilled class="mx-auto mb-4 h-12 w-12" />

			<p>
				Your The Wordsmith's Collection account has been successfully created.
			</p>
			<p>Start reading now!</p>
		</div>
		<Link
			href="/"
			class="button"
		>
			Go to Home
		</Link>
	</RegisterLayout>
</template>
