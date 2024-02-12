<script setup>
defineProps({
	inputId: {
		type: String,
		required: true,
	},
	inputSize: {
		type: String,
		required: false,
		default: "h-4 w-4",
	},
	labelClass: {
		type: String,
		required: false,
		default: "text-sm font-medium",
	},
});

const value = defineModel("value"); // eslint-disable-line
</script>

<template>
	<div class="flex items-center">
		<input
			:id="inputId"
			v-model="value"
			type="checkbox"
			:class="`rounded border-skin-border bg-skin-primary-offset text-skin-secondary focus:ring-2 focus:ring-skin-secondary ${inputSize}`"
		/>
		<label
			:for="inputId"
			:class="`ms-2 ${labelClass}`"
		>
			<slot />
		</label>
	</div>
</template>
