<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";

const props = defineProps({
	status: {
		type: String,
		required: false,
		default: null,
	},
});

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

const form = useForm({});

const submit = () => {
	form.post("/email/verification-notification"); //route("verification.send"));
};

const verificationLinkSent = computed(
	() => props.status === "verification-link-sent"
);
</script>

<template>
	<AppHead
		title="Payment"
		description="Verify your The Wordsmith's Collection account to start reading a vast library of the greatest works of literature."
	/>

	<RegisterLayout
		header-title="Verify your email address"
		:subscription-plan="subscriptionPlan"
		:current-step="2"
	>
		<p>
			Thanks for signing up! Before getting started, could you verify your email
			address (<strong>{{ usePage().props.auth.user.email }}</strong
			>) by clicking on the link we just emailed to you? If you didn't receive
			the email, we will gladly send you another.
		</p>

		<div
			v-if="verificationLinkSent"
			class="mt-4 font-medium text-skin-success"
		>
			A new verification link has been sent to the email address.
		</div>

		<form @submit.prevent="submit">
			<div class="mt-4 grid grid-cols-3 items-center justify-between">
				<button
					class="button col-span-2"
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
				>
					Resend verification email
				</button>

				<!-- :href="route('logout')" -->
				<Link
					href="/logout"
					method="post"
					as="button"
					class="text-skin-danger underline hover:text-skin-danger-light"
				>
					Log Out
				</Link>
			</div>
		</form>
	</RegisterLayout>
</template>
