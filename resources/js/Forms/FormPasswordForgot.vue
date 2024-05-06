<script setup>
import { useForm } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";

const emit = defineEmits(["success"]);

const props = defineProps({
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
});

const submit = () => {
	form.post("/forgot-password", {
		preserveScroll: props.preserveScroll,
		preserveState: props.preserveState,
		onSuccess: () => {
			emit("success");
		},
	});
};
</script>

<template>
	<form
		class="space-y-6"
		@submit.prevent="submit"
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

		<button
			type="submit"
			class="button w-full font-bold"
			:class="{ 'opacity-25': form.processing }"
			:disabled="form.processing"
		>
			{{ trans("form.password_forgot.send_email") }}
		</button>
	</form>
</template>
