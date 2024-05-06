<script setup>
import { trans } from "laravel-vue-i18n";

const selectedOptionId = defineModel("value"); // eslint-disable-line

defineProps({
	selectId: {
		type: String,
		required: true,
	},
	labelText: {
		type: String,
		required: true,
	},
	options: {
		type: Array,
		required: true,
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
		<div class="relative z-0 w-full rounded-lg">
			<select
				:id="selectId"
				v-model="selectedOptionId"
				:required="isRequired"
				:disabled="isDisabled"
				class="peer block w-full rounded-lg p-4 text-sm focus:ring-2 disabled:pointer-events-none disabled:opacity-50"
				:class="{
					'border-skin-success focus:border-skin-success focus:ring-skin-success':
						successMessage,
					'border-skin-danger focus:border-skin-danger focus:ring-skin-danger':
						errorMessage,
					'border-skin-border focus:border-skin-secondary focus:ring-skin-secondary':
						!successMessage && !errorMessage,
					'pb-2 pt-6': selectedOptionId,
				}"
			>
				<option
					value=""
					:disabled="isRequired"
					:hidden="isRequired"
				></option>
				<option
					v-for="(option, index) in options"
					:key="index"
					:value="option.id"
				>
					{{ option.name }}
				</option>
			</select>

			<label
				:for="selectId"
				class="pointer-events-none absolute start-0 top-0 h-full truncate border border-transparent p-4 text-sm transition duration-100 ease-in-out peer-focus:-translate-y-1.5 peer-focus:text-xs peer-focus:text-skin-muted peer-disabled:pointer-events-none peer-disabled:opacity-50"
				:class="{
					'-translate-y-1.5 text-xs text-skin-muted': selectedOptionId,
				}"
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
			:id="`${selectId}-success`"
			class="mt-2 text-xs text-skin-success"
		>
			{{ successMessage }}
		</p>

		<p
			v-if="errorMessage"
			:id="`${selectId}-error`"
			class="mt-2 text-xs text-skin-danger"
		>
			{{ errorMessage }}
		</p>
	</div>
</template>
