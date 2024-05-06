<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
	current_password: null,
	password: null,
	password_confirmation: null,
});

const updatePassword = () => {
	form.put("/password", {
		preserveScroll: true,
		onSuccess: () => form.reset(),
		onError: () => {
			if (form.errors.password) {
				form.reset("password", "password_confirmation");
				passwordInput.value.focus();
			}
			if (form.errors.current_password) {
				form.reset("current_password");
				currentPasswordInput.value.focus();
			}
		},
	});
};
</script>

<template>
	<form @submit.prevent="updatePassword">
		<FloatingLabel
			ref="currentPasswordInput"
			v-model:value="form.current_password"
			input-id="current_password"
			input-type="password"
			input-autocomplete="current-password"
			:label-text="trans('form.password_update.current_password')"
			is-required
			:error-message="form.errors.current_password"
		/>

		<FloatingLabel
			ref="passwordInput"
			v-model:value="form.password"
			input-id="new_password"
			input-type="password"
			input-autocomplete="new-password"
			:label-text="trans('form.password_update.new_password')"
			is-required
			:error-message="form.errors.password"
		/>

		<FloatingLabel
			v-model:value="form.password_confirmation"
			input-id="password_confirmation"
			input-type="password"
			input-autocomplete="new-password"
			:label-text="trans('common.noun.password_confirmation')"
			is-required
			:error-message="form.errors.password_confirmation"
		/>

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
