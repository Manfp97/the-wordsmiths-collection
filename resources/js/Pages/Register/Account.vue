<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import IconRightArrow from "@icons/right-arrow.svg?component";

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
		title="Account"
		description="Create your account to continue with the registration process for The Wordsmith's Collection."
	/>

	<RegisterLayout
		:header-title="'Account details'"
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

			<div class="flex items-start">
				<div class="flex h-5 items-center">
					<input
						id="remember"
						type="checkbox"
						value=""
						class="focus:ring-3 h-4 w-4 cursor-pointer rounded border border-skin-border focus:ring-skin-secondary"
						required
					/>
				</div>
				<label
					for="remember"
					class="ms-2 text-sm font-medium"
				>
					<span
						id="terms-description"
						class="text-sm text-skin-text-muted"
					>
						I agree to the
						<a
							class="underline"
							href="#"
							target="_blank"
							rel="noopener"
						>
							Terms and Conditions
						</a>
					</span>
				</label>
			</div>

			<Link
				href="/register/verification#form"
				class="my-2 flex items-center justify-center rounded-md bg-skin-secondary py-3 font-bold hover:bg-skin-secondary-offset"
			>
				Continue

				<IconRightArrow
					class="ml-4 h-4 w-4"
					fill="none"
					stroke="currentColor"
					stroke-width="2"
				/>
			</Link>

			<p class="text-center text-sm text-skin-text-muted">
				Already have an account?
				<Link
					href="/login"
					class="text-skin-link hover:underline"
				>
					Login here
				</Link>
			</p>
		</form>
	</RegisterLayout>
</template>
