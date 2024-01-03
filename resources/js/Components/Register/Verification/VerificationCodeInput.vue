<script setup>
defineProps({
	index: {
		type: Number,
		required: true,
	},
});

const focusNextInput = (event, index) => {
	const nextIndex = index + 1;
	const $nextInput = document.getElementById(`code-${nextIndex}`);

	if (event.target.value != "" && $nextInput) {
		$nextInput.focus();
	}
};
</script>

<template>
	<div>
		<label
			for="code-1"
			class="sr-only"
		>
			Code {{ index }}
		</label>
		<input
			:id="`code-${index}`"
			type="text"
			maxlength="1"
			required
			autocomplete="off"
			class="bg-skin-primary-offset uppercase block h-12 w-12 rounded-lg border border-skin-border py-3 text-center text-2xl font-bold focus:border-skin-secondary focus:ring-skin-secondary lg:text-4xl lg:h-16 lg:w-16"
			@input="(event) => focusNextInput(event, index)"
		/>
	</div>
</template>
