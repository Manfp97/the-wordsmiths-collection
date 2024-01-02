<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import FloatingLabel from "@/Components/Common/FloatingLabel.vue";
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
	]
};
</script>

<template>
	<AppHead
		title="Account"
		description="Create your account to continue with the registration process for The Wordsmith's Collection."
	/>

	<RegisterLayout
		:header-title="'Create an account'"
		:subscription-plan="subscriptionPlan"
		:current-step="1"
	>
		<form
			class="space-y-6"
			action="#"
		>
			<FloatingLabel
				:id="'username'"
				label-text="Your username"
				:type="'text'"
				:autocomplete="'off'"
			/>
			<FloatingLabel
				:id="'email'"
				label-text="Your email"
				:type="'email'"
				:autocomplete="'off'"
			/>
			<FloatingLabel
				:id="'password'"
				label-text="Your password"
				:type="'password'"
				:autocomplete="'new-password'"
			/>

			<Link
				href="/register/payment"
				class="hover:bg-skin-secondary-offset my-2 flex items-center justify-center rounded-md bg-skin-secondary py-3 font-bold"
			>
				Continue
				<svg
					xmlns="http://www.w3.org/2000/svg"
					class="ml-4 h-4 w-4"
					fill="none"
					viewBox="0 0 24 24"
					stroke="currentColor"
					stroke-width="2"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						d="M14 5l7 7m0 0l-7 7m7-7H3"
					/>
				</svg>
			</Link>
		</form>
	</RegisterLayout>
</template>
