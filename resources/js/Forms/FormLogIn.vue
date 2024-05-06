<script setup>
import { useForm } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";

const emit = defineEmits(["success"]);

const props = defineProps({
	canResetPassword: {
		type: Boolean,
		required: false,
		default: true,
	},
	preserveScroll: {
		type: Boolean,
		required: false,
		default: true,
	},
	preserveState: {
		type: [String, Boolean],
		required: false,
		default: true,
	},
});

const form = useForm({
	email: null,
	password: null,
	remember: false,
});

const submitForm = () => {
	form.post("/login", {
		preserveScroll: props.preserveScroll,
		preserveState: props.preserveState,
		onFinish: () => form.reset("password"),
		onSuccess: () => {
			form.reset();
			form.clearErrors();
			emit("success");
		},
	});
};
</script>

<template>
	<form
		class="space-y-6"
		@submit.prevent="submitForm"
	>
		<FloatingLabel
			v-model:value="form.email"
			input-id="email"
			:label-text="trans('common.noun.email')"
			input-type="email"
			input-autocomplete="email"
			is-required
			:error-message="form.errors.email"
		/>
		<FloatingLabel
			v-model:value="form.password"
			input-id="password"
			:label-text="trans('common.noun.password')"
			input-type="password"
			input-autocomplete="current-password"
			is-required
			:error-message="form.errors.password"
		/>

		<div class="flex items-start">
			<Checkbox
				v-model:value="form.remember"
				input-id="remember"
			>
				{{ trans("form.log_in.remember_me") }}
			</Checkbox>

			<Link
				v-if="canResetPassword"
				href="/forgot-password"
				class="ms-auto text-sm text-skin-link underline hover:text-skin-text"
			>
				{{ trans("form.log_in.forgot_password") }}
			</Link>
		</div>

		<button
			type="submit"
			class="w-full rounded-lg !bg-skin-secondary px-5 py-2.5 text-center text-sm font-bold hover:!bg-skin-secondary-offset focus:outline-none focus:ring-4 focus:ring-skin-border"
			:class="{ 'opacity-25': form.processing }"
			:disabled="form.processing"
		>
			{{ trans("common.action.log_in") }}
		</button>

		<div class="text-center text-sm font-medium text-skin-muted">
			{{ trans("form.log_in.not_registered") }}
			<Link
				href="/subscribe"
				class="text-skin-link underline hover:text-skin-text"
			>
				{{ trans("form.log_in.select_subscription_plan") }}
			</Link>
			{{ trans("form.log_in.to_create_your_account") }}
		</div>
	</form>
</template>
