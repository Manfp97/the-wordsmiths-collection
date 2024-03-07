<script setup>
// https://preline.co/docs/input.html#floating-label

const value = defineModel("value"); // eslint-disable-line

defineProps({
	inputId: {
		type: String,
		required: true,
	},
	labelText: {
		type: String,
		required: true,
	},
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
	inputRequired: {
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
			<input
				:id="inputId"
				v-model="value"
				:type="inputType"
				:required="inputRequired"
				:autocomplete="inputAutocomplete"
				:inputmode="inputMode"
				class="peer block w-full rounded-lg border-skin-border p-4 text-sm placeholder:text-transparent autofill:pb-2 autofill:pt-6 focus:border-skin-secondary focus:pb-2 focus:pt-6 focus:ring-2 focus:ring-skin-secondary disabled:pointer-events-none disabled:opacity-50 [&:not(:placeholder-shown)]:pb-2 [&:not(:placeholder-shown)]:pt-6"
				:class="{
					'border-skin-success': successMessage,
					'border-skin-danger': errorMessage,
				}"
				:placeholder="inputPlaceholder"
				:maxlength="inputMaxLength"
				:aria-errormessage="errorMessage ? `${inputId}-error` : null"
				:aria-invalid="errorMessage ? true : false"
				:aria-describedby="`${inputId}-annotation`"
			/>
			<label
				:for="inputId"
				class="pointer-events-none absolute start-0 top-0 h-full truncate border border-transparent p-4 text-sm transition duration-100 ease-in-out peer-focus:-translate-y-1.5 peer-focus:text-xs peer-focus:text-skin-text-muted peer-disabled:pointer-events-none peer-disabled:opacity-50 peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:text-skin-text-muted"
			>
				{{ labelText }}
			</label>
		</div>

		<p
			v-if="successMessage"
			:id="`${id}-success`"
			class="mt-2 text-xs text-skin-success"
		>
			{{ successMessage }}
		</p>

		<p
			v-if="errorMessage"
			:id="`${id}-error`"
			class="mt-2 text-xs text-skin-danger"
		>
			{{ errorMessage }}
		</p>
	</div>
</template>
