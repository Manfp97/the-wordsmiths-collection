<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import IconCheckCircleFilled from "@icons/check-circle-filled.svg?component";

const subscriptionPlan = {
	name: "Basic",
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
		title="Confirmation"
		description="Congratulations! Your The Wordsmith's Collection account has been successfully created. Start reading now!"
	/>

	<RegisterLayout
		:header-title="'Registration completed'"
		:subscription-plan="subscriptionPlan"
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
			href="/login"
			class="button"
		>
			Log in to your account
		</Link>
	</RegisterLayout>
</template>
