<script setup>
import IconCheck from "@icons/check.svg?component";
import IconX from "@icons/x.svg?component";

defineProps({
	isCheck: {
		type: Boolean,
		required: true,
	},
	text: {
		type: String,
		required: true,
	},
});
</script>

<template>
	<li class="flex items-center space-x-3">
		<IconCheck
			v-if="isCheck"
			class="h-5 w-5 shrink-0 text-skin-success"
			fill="currentColor"
		/>
		<IconX
			v-else
			class="h-5 w-5 shrink-0 text-skin-danger"
			stroke="currentColor"
			fill="currentColor"
		/>

		<!-- eslint-disable-next-line vue/no-v-html -->
		<span v-html="text" />
	</li>
</template>
