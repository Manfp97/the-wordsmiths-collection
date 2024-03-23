<script setup>
// https://preline.co/docs/textarea.html#floating-label

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

const value = defineModel("value"); // eslint-disable-line

const autoGrow = (e) => {
	const element = e.target;
	element.style.height = "5px";
	element.style.height = element.scrollHeight + "px";
};
</script>

<template>
	<div class="relative">
		<textarea
			:id="textareaId"
			v-model="value"
			class="peer block w-full resize-none overflow-hidden rounded-lg border-skin-border p-4 text-sm shadow-sm placeholder:text-skin-transparent autofill:pb-2 autofill:pt-6 focus:border-skin-secondary focus:pb-2 focus:pt-6 focus:ring-2 focus:ring-skin-secondary disabled:pointer-events-none disabled:opacity-50 [&:not(:placeholder-shown)]:pb-2 [&:not(:placeholder-shown)]:pt-6"
			:class="textareaClass"
			:placeholder="placeholderText"
			:required="isRequired"
			@input="autoGrow"
		></textarea>
		<label
			:for="textareaId"
			class="pointer-events-none absolute start-0 top-0 h-full truncate border border-transparent p-4 text-sm transition duration-100 ease-in-out peer-focus:-translate-y-1.5 peer-focus:text-xs peer-focus:text-skin-text-muted peer-disabled:pointer-events-none peer-disabled:opacity-50 peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-xs peer-[:not(:placeholder-shown)]:text-skin-text-muted"
		>
			{{ labelText }}
		</label>

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
