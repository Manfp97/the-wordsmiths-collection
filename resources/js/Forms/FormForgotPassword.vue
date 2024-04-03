<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";

const props = defineProps({
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
		preserveState: props.preserveState,
	}); // route(password.email)
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
			label-text="Your email"
			input-type="email"
			input-autocomplete="email"
			input-required
			:error-message="form.errors.email"
		/>

		<button
			type="submit"
			class="button w-full font-bold"
			:class="{ 'opacity-25': form.processing }"
			:disabled="form.processing"
		>
			Send email
		</button>
	</form>
</template>
