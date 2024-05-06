<script setup>
// https://preline.co/docs/textarea.html#floating-label
import { ref, watch, nextTick, onMounted } from "vue";
import { trans } from "laravel-vue-i18n";

const value = defineModel("value"); // eslint-disable-line

defineProps({
	textareaId: {
		type: String,
		required: true,
	},
	labelText: {
		type: String,
		required: false,
		default: "",
	},
	textareaClass: {
		type: String,
		required: false,
		default: "",
	},
	placeholderText: {
		type: String,
		required: false,
		default: "",
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

onMounted(() => {
	autoGrow();
});

const $textarea = ref(null);

watch(
	() => value.value,
	(newValue) => {
		if (newValue) {
			autoGrow();
		}
	}
);

const autoGrow = () => {
	nextTick(() => {
		$textarea.value.style.height = "5px";
		// Access the scrollHeight after the DOM has been fully updated
		$textarea.value.style.height = $textarea.value.scrollHeight + "px";
	});
};
</script>

<template>
	<div class="relative">
		<textarea
			:id="textareaId"
			ref="$textarea"
			v-model="value"
			class="peer block w-full resize-none overflow-hidden rounded-lg p-4 text-sm shadow-sm placeholder:text-skin-transparent autofill:pb-2 autofill:pt-6 focus:pb-2 focus:pt-6 focus:ring-2 disabled:pointer-events-none disabled:opacity-50 [&:not(:placeholder-shown)]:pb-2 [&:not(:placeholder-shown)]:pt-6"
			:class="{
				[textareaClass]: !!textareaClass,
				'border-skin-success text-skin-success focus:border-skin-success focus:ring-skin-success':
					successMessage,
				'border-skin-danger text-skin-danger focus:border-skin-danger focus:ring-skin-danger':
					errorMessage,
				'border-skin-border focus:border-skin-secondary focus:ring-skin-secondary':
					!successMessage && !errorMessage,
			}"
			:placeholder="placeholderText"
			:required="isRequired"
			@input="autoGrow"
		></textarea>
		<label
			:for="textareaId"
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

		<p
			v-if="successMessage"
			:id="`${textareaId}-success`"
			class="mt-2 text-xs text-skin-success"
		>
			{{ successMessage }}
		</p>

		<p
			v-if="errorMessage"
			:id="`${textareaId}-error`"
			class="mt-2 text-xs text-skin-danger"
		>
			{{ errorMessage }}
		</p>
	</div>
</template>
