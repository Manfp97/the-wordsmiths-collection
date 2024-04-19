<script setup>
import { useForm } from "@inertiajs/vue3";
import IconRightArrow from "@icons/right-arrow.svg?component";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import IconEdit from "@icons/edit.svg?component";

const emit = defineEmits(["success"]);

const props = defineProps({
	formId: {
		type: String,
		required: true,
	},
	creditCard: {
		type: Object,
		required: false,
		default: null,
	},
	httpMethod: {
		type: String,
		required: true,
	},
	preserveScroll: {
		type: Boolean,
		required: false,
		default: true,
	},
	preserveState: {
		type: [String, Boolean],
		required: false,
		default: true,
	},
});

const form = useForm({
	cardholder_name: props.creditCard?.cardholder_name,
	card_number: null,
	expiration_month: props.creditCard?.expiration_month,
	expiration_year: props.creditCard?.expiration_year,
	cvc: null,
});

const buttonText = props.httpMethod === "post" ? "Pay" : "Update details";

const submitForm = () => {
	const url =
		props.httpMethod === "post"
			? "/payment"
			: `/payment/${props.creditCard?.id}`;

	form
		.transform((data) => ({
			...data,
			expiration_year: `20${form.expiration_year}`,
			_method: props.httpMethod,
		}))
		[props.httpMethod](url, {
			preserveScroll: props.preserveScroll,
			preserveState: props.preserveState,
			onSuccess: () => {
				form.reset();
				form.clearErrors();
				emit("success");
			},
		});
};
</script>

<template>
	<form
		class="space-y-6"
		@submit.prevent="submitForm"
	>
		<FloatingLabel
			v-model:value="form.cardholder_name"
			input-id="cardholder-name"
			label-text="Name on card"
			input-type="text"
			input-autocomplete="cc-name"
			is-required
			:error-message="form.errors.cardholder_name"
		/>

		<div>
			<span
				class="mb-2 flex flex-row space-x-2"
				aria-label="We accept Visa, Mastercard and American Express."
			>
				<img
					v-for="(paymentMethod, index) in ['VISA', 'MASTERCARD', 'AMEX']"
					:key="index"
					:src="`/images/register/payment/${paymentMethod}.png`"
					:srcset="`/images/register/payment/${paymentMethod}@2x.png 2x`"
					:alt="paymentMethod"
					class="h-6"
				/>
			</span>

			<FloatingLabel
				v-model:value="form.card_number"
				input-id="card-number"
				label-text="Card number"
				input-type="number"
				input-autocomplete="cc-number"
				input-mode="numeric"
				:input-max-length="24"
				:error-message="form.errors.card_number"
				is-required
				@input="form.card_number = $event.target.value.slice(0, 24)"
			/>
		</div>

		<div
			class="sm:flex sm:flex-row sm:items-center sm:justify-between sm:gap-6 max-sm:space-y-6"
		>
			<div
				class="flex flex-col rounded-lg border border-skin-border bg-skin-white px-4 py-1 sm:w-2/5"
			>
				<label class="mt-1 text-xs text-skin-muted">Expiration date</label>
				<div class="flex w-full justify-start space-x-2">
					<input
						id="expiryMonth"
						v-model="form.expiration_month"
						type="number"
						inputmode="numeric"
						max="12"
						placeholder="MM"
						class="w-9 rounded-lg border-none p-0 focus:ring-0"
						autocomplete="cc-exp-month"
						required
						@input="form.expiration_month = $event.target.value.slice(0, 2)"
					/>
					/
					<input
						id="expiryYear"
						v-model="form.expiration_year"
						type="number"
						inputmode="numeric"
						min="24"
						max="49"
						placeholder="YY"
						class="w-9 rounded-lg border-none p-0 focus:ring-0"
						autocomplete="cc-exp-year"
						required
						@input="form.expiration_year = $event.target.value.slice(0, 2)"
					/>
				</div>

				<p
					v-if="form.errors.expiration_month || form.errors.expiration_year"
					class="mt-2 text-sm text-skin-danger"
				>
					The expiry date is invalid
				</p>
			</div>

			<div class="flex flex-row items-center space-x-2 sm:w-3/5">
				<FloatingLabel
					v-model:value="form.cvc"
					class="w-16"
					input-id="cvc"
					label-text="CVC"
					input-type="text"
					input-autocomplete="cc-csc"
					input-mode="numeric"
					:input-max-length="3"
					is-required
					:error-message="form.errors.cvc"
					@input="form.cvc = $event.target.value.slice(0, 3)"
				/>

				<img
					:src="'/images/register/payment/cvv.svg'"
					class="h-8 w-16"
				/>

				<p class="text-sm text-skin-muted">
					Last 3 digits on the back of the card
				</p>
			</div>
		</div>

		<slot name="subscriptionPlan" />

		<div class="flex justify-end space-x-4">
			<button
				type="submit"
				class="button"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				<IconEdit
					v-if="httpMethod === 'put'"
					class="mr-1 h-6 w-6"
				/>
				{{ buttonText }}
				<IconRightArrow
					v-if="httpMethod === 'post'"
					class="ml-4 h-4 w-4"
					fill="none"
					stroke="currentColor"
					stroke-width="2"
				/>
			</button>
		</div>
	</form>
</template>
