<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";

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
});

const user = usePage().props.auth.user;

const form = useForm({
	username: user.username,
	email: user.email,
});
</script>

<template>
	<section>
		<header>
			<h2 class="pb-3 font-means-web text-2xl font-bold">
				Profile information
			</h2>

			<p class="mt-1 text-sm text-gray-600">
				Update your account's profile information and email address.
			</p>
		</header>

		<form
			class="mt-6 space-y-6"
			@submit.prevent="form.patch('/profile')"
		>
			<!-- @submit.prevent="form.patch(route('profile.update'))" -->
			<FloatingLabel
				v-model:value="form.username"
				input-id="username"
				input-type="text"
				input-autocomplete="name"
				label-text="Username"
				input-required
				:error-message="form.errors.username"
			/>

			<FloatingLabel
				v-model:value="form.email"
				input-id="email"
				input-type="text"
				input-autocomplete="email"
				label-text="Email"
				input-required
				:error-message="form.errors.email"
			/>

			<div v-if="mustVerifyEmail && user.email_verified_at === null">
				<p class="mt-2 text-sm text-gray-800">
					Your email address is unverified.
					<!-- route('verification.send')  -->
					<Link
						href="/email/verification-notification"
						method="post"
						as="button"
						class="rounded-md text-sm text-skin-muted underline hover:text-skin-text focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
					>
						Click here to re-send the verification email.
					</Link>
				</p>

				<div
					v-show="status === 'verification-link-sent'"
					class="mt-2 text-sm font-medium text-skin-success"
				>
					A new verification link has been sent to your email address.
				</div>
			</div>

			<div class="flex items-center gap-4">
				<button
					class="button"
					:disabled="form.processing"
				>
					Save
				</button>

				<Transition
					enter-active-class="transition ease-in-out"
					enter-from-class="opacity-0"
					leave-active-class="transition ease-in-out"
					leave-to-class="opacity-0"
				>
					<p
						v-if="form.recentlySuccessful"
						class="text-sm text-skin-muted"
					>
						Saved.
					</p>
				</Transition>
			</div>
		</form>
	</section>
</template>
