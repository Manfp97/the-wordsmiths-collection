<script setup>
import { ref } from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

defineProps({
	inputId: {
		type: String,
		required: true,
	},
	labelText: {
		type: String,
		required: true,
	},
	isRequired: {
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

const date = defineModel("value"); // eslint-disable-line
const isOpen = defineModel("open"); // eslint-disable-line

// All labels: https://vue3datepicker.com/props/localization/#aria-labels
const ariaLabels = ref({ menu: "Some custom menu label" });
</script>

<template>
	<div class="space-y-1">
		<label
			:for="inputId"
			class="font-medium"
		>
			<span class="text-sm">
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
					(optional)
				</span>
			</span>
		</label>

		<VueDatePicker
			:id="inputId"
			v-model="date"
			v-bind="$attrs"
			:input-class-name="`!rounded-lg shadow-sm !py-3 hover:!border-skin-border ${
				isOpen ? 'ring-2 ring-skin-secondary border-skin-secondary' : ''
			}`"
			:aria-labels="ariaLabels"
			:required="isRequired"
		/>

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
