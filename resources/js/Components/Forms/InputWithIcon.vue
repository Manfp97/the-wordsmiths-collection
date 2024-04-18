<script setup>
const value = defineModel("value"); // eslint-disable-line

defineProps({
	inputType: {
		type: String,
		required: true,
	},
	inputAutocomplete: {
		type: String,
		required: false,
		default: "on",
	},
	inputMode: {
		type: String,
		required: false,
		default: "text",
	},
	inputPlaceholder: {
		type: String,
		required: false,
		default: "",
	},
	inputMaxLength: {
		type: String,
		required: false,
		default: null,
	},
	iconAriaLabel: {
		type: String,
		required: false,
		default: "",
	},
	isRequired: {
		type: Boolean,
		required: false,
		default: false,
	},
	isDisabled: {
		type: Boolean,
		required: false,
		default: false,
	},
	successMessage: {
		type: String,
		required: false,
		default: null,
	},
	errorMessage: {
		type: String,
		required: false,
		default: null,
	},
});
</script>

<template>
	<div>
		<div class="relative">
			<div
				class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3"
			>
				<slot />
				<span class="sr-only">{{ iconAriaLabel }} icon</span>
			</div>
			<input
				v-model="value"
				:type="inputType"
				class="block w-full rounded-lg border p-2 ps-10 text-sm text-skin-text focus:ring-2"
				:class="{
					'border-skin-success text-skin-success focus:border-skin-success focus:ring-skin-success':
						successMessage,
					'border-skin-danger text-skin-danger focus:border-skin-danger focus:ring-skin-danger':
						errorMessage,
					'border-skin-border focus:border-skin-secondary focus:ring-skin-secondary':
						!successMessage && !errorMessage,
				}"
				:autocomplete="inputAutocomplete"
				:placeholder="inputPlaceholder"
				:required="isRequired"
				:disabled="isDisabled"
			/>
		</div>

		<p
			v-if="successMessage"
			class="mt-2 text-xs text-skin-success"
		>
			{{ successMessage }}
		</p>

		<p
			v-if="errorMessage"
			class="mt-2 text-xs text-skin-danger"
		>
			{{ errorMessage }}
		</p>
	</div>
</template>
