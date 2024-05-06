<script setup>
// https://preline.co/docs/input.html#floating-label
import { trans } from "laravel-vue-i18n";

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
	labelClass: {
		type: String,
		required: false,
		default: "capitalize",
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
		<div class="relative rounded-lg shadow-sm">
			<input
				:id="inputId"
				v-model="value"
				:type="inputType"
				:autocomplete="inputAutocomplete"
				:inputmode="inputMode"
				:placeholder="inputPlaceholder"
				:maxlength="inputMaxLength"
				:required="isRequired"
				:disabled="isDisabled"
				class="peer block w-full rounded-lg p-4 text-sm placeholder:text-transparent autofill:pb-2 autofill:pt-6 focus:pb-2 focus:pt-6 focus:ring-2 disabled:pointer-events-none disabled:opacity-50 [&:not(:placeholder-shown)]:pb-2 [&:not(:placeholder-shown)]:pt-6"
				:class="{
					'border-skin-success text-skin-success focus:border-skin-success focus:ring-skin-success':
						successMessage,
					'border-skin-danger text-skin-danger focus:border-skin-danger focus:ring-skin-danger':
						errorMessage,
					'border-skin-border focus:border-skin-secondary focus:ring-skin-secondary':
						!successMessage && !errorMessage,
				}"
				:aria-errormessage="errorMessage ? `${inputId}-error` : null"
				:aria-invalid="errorMessage ? true : false"
				:aria-describedby="`${inputId}-annotation`"
			/>
			<label
				:for="inputId"
				class="pointer-events-none absolute start-0 top-0 h-full truncate border border-transparent p-4 text-sm transition duration-100 ease-in-out peer-focus:-translate-y-1.5 peer-focus:text-xs peer-focus:text-skin-muted peer-disabled:pointer-events-none peer-disabled:opacity-50 peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:text-skin-muted"
			>
				{{ labelText }}
				<span
					v-if="isRequired"
					class="text-skin-danger"
				>
					*
				</span>
				<span
					v-else
					class="text-skin-muted"
				>
					{{ trans("components.forms.optional") }}
				</span>
			</label>
		</div>

		<p
			v-if="successMessage"
			:id="`${inputId}-success`"
			class="mt-2 text-xs text-skin-success"
		>
			{{ successMessage }}
		</p>

		<p
			v-if="errorMessage"
			:id="`${inputId}-error`"
			class="mt-2 text-xs text-skin-danger"
		>
			{{ errorMessage }}
		</p>
	</div>
</template>
