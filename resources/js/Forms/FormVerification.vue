<script setup>
import { useForm } from "@inertiajs/vue3";
import PinCodeInput from "@/Components/Forms/PinCodeInput.vue";
import IconRightArrow from "@icons/right-arrow.svg?component";

const form = useForm({
	verification_code: [],
});

const submitForm = () => {
	form.post("/register/verification", {
		onSuccess: () => {
			form.reset();
			form.clearErrors();
		},
	});
};
</script>

<template>
	<form
		class="space-y-6"
		@submit.prevent="submitForm"
	>
		<div class="my-4 md:my-6">
			<PinCodeInput
				v-model:value="form.verification_code"
				:inputs-number="6"
				explanation-text="Make sure to keep this window open while you check your inbox."
			/>
		</div>

		<button
			type="submit"
			class="my-2 flex w-full items-center justify-center rounded-md bg-skin-secondary px-5 py-3 font-bold hover:bg-skin-secondary-offset"
			:disabled="form.processing"
		>
			Verify account
			<IconRightArrow
				class="ml-4 h-4 w-4"
				fill="none"
				stroke="currentColor"
				stroke-width="2"
			/>
		</button>
	</form>
</template>
