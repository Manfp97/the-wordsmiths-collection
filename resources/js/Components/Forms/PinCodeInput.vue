<script setup>
defineProps({
	inputsNumber: {
		type: Number,
		required: true,
	},
	explanationText: {
		type: String,
		required: false,
		default: "",
	},
});

const pin = defineModel("value"); // eslint-disable-line

const focusNextInput = (el, prevId, nextId) => {
	if (el.value.length === 0) {
		document.getElementById(prevId).focus();
	} else {
		document.getElementById(nextId).focus();
	}
};
</script>

<template>
	<div class="flex flex-col items-center justify-center">
		<div class="flex justify-center space-x-2 rtl:space-x-reverse sm:space-x-4">
			<div
				v-for="inputNumber in inputsNumber"
				:key="inputNumber"
			>
				<label
					:for="`code-${inputNumber}`"
					class="sr-only"
				>
					Code {{ inputNumber }}
				</label>
				<input
					:id="`code-${inputNumber}`"
					type="text"
					maxlength="1"
					required
					autocomplete="off"
					class="block h-12 w-12 rounded-lg border border-skin-border bg-skin-primary-offset py-3 text-center text-2xl font-bold uppercase shadow-sm focus:border-skin-secondary focus:ring-skin-secondary lg:h-16 lg:w-16 lg:text-4xl"
					@keyup="
						if ($event.key !== 'Tab') {
							pin[inputNumber - 1] = $event.target.value.trim() || null;

							focusNextInput(
								$event.target,
								`code-${inputNumber == 1 ? 1 : inputNumber - 1}`,
								`code-${
									inputNumber == inputsNumber.length
										? inputNumber
										: inputNumber + 1
								}`
							);
						}
					"
				/>
			</div>
		</div>

		<p class="mt-3 text-sm text-skin-muted">{{ explanationText }}</p>
	</div>
</template>
