<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
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
	<form @submit.prevent="form.patch('/profile')">
		<FloatingLabel
			v-model:value="form.username"
			input-id="username"
			input-type="text"
			input-autocomplete="name"
			:label-text="trans('common.noun.username')"
			is-required
			:error-message="form.errors.username"
		/>

		<FloatingLabel
			v-model:value="form.email"
			input-id="email"
			input-type="text"
			input-autocomplete="email"
			:label-text="trans('common.noun.email')"
			is-required
			:error-message="form.errors.email"
		/>

		<div v-if="mustVerifyEmail && user.email_verified_at === null">
			<p class="mt-2 text-sm text-skin-muted">
				{{ trans("form.profile_information_update.unverified_email") }}
				<Link
					href="/email/verification-notification"
					method="post"
					as="button"
					class="rounded-md text-sm text-skin-muted underline hover:text-skin-text focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
				>
					{{ trans("form.profile_information_update.re_send_email") }}
				</Link>
			</p>

			<div
				v-show="status === 'verification-link-sent'"
				class="mt-2 text-sm font-medium text-skin-success"
			>
				{{ trans("form.profile_information_update.new_email_sent") }}
			</div>
		</div>

		<div class="flex items-center gap-4">
			<button
				class="button"
				:disabled="form.processing"
			>
				{{ trans("common.action.save") }}
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
					{{ trans("common.action.saved") }}.
				</p>
			</Transition>
		</div>
	</form>
</template>
