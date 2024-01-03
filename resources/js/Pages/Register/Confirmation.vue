<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";

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
			<svg
				xmlns="http://www.w3.org/2000/svg"
				class="mx-auto mb-4 h-12 w-12"
				viewBox="0 0 48 48"
			>
				<path
					fill="#c8e6c9"
					d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"
				/>
				<path
					fill="#4caf50"
					d="M34.586,14.586l-13.57,13.586l-5.602-5.586l-2.828,2.828l8.434,8.414l16.395-16.414L34.586,14.586z"
				/>
			</svg>

			<p>
				Your The Wordsmith's Collection account has been successfully created.
			</p>
			<p>Start reading now!</p>
		</div>
		<Link
			href="/login"
			class="hover:bg-skin-secondary-offset my-2 flex items-center justify-center rounded-md bg-skin-secondary py-3 font-bold"
		>
			Log in to your account
		</Link>
	</RegisterLayout>
</template>
