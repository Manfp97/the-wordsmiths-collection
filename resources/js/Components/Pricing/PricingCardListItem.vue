<script setup>
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
		<svg
			v-if="isCheck"
			class="h-5 w-5 shrink-0 text-green-500"
			fill="currentColor"
			viewBox="0 0 20 20"
			xmlns="http://www.w3.org/2000/svg"
		>
			<path
				fill-rule="evenodd"
				d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
				clip-rule="evenodd"
			/>
		</svg>

		<svg
			v-if="!isCheck"
			xmlns="http://www.w3.org/2000/svg"
			class="h-5 w-5 shrink-0 text-red-500"
			viewBox="0 0 24 24"
			stroke-width="2"
			stroke="currentColor"
			fill="none"
			stroke-linecap="round"
			stroke-linejoin="round"
		>
			<path
				stroke="none"
				d="M0 0h24v24H0z"
				fill="none"
			/>
			<path d="M18 6l-12 12" />
			<path d="M6 6l12 12" />
		</svg>
		<!-- eslint-disable-next-line vue/no-v-html -->
		<span v-html="text" />
	</li>
</template>
