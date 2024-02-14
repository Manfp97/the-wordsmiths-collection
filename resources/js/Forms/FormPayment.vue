<script setup>
import { useForm } from "@inertiajs/vue3";
import IconRightArrow from "@icons/right-arrow.svg?component";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";

defineProps({
	subscriptionPlanName: {
		type: String,
		required: false,
		default: null,
	},
	subscriptionPrice: {
		type: String,
		required: false,
		default: null,
	},
});

const form = useForm({
	cardholderName: null,
	cvv: null,
	cardNumber: null,
	expiryMonth: null,
	expiryYear: null,
});

const submitForm = () => {
	form.post("/register/payment", {
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
		<FloatingLabel
			v-model:value="form.cardholderName"
			input-id="cardholder-name"
			label-text="Name on card"
			input-type="text"
			input-autocomplete="cc-name"
			:error-message="form.errors.cardholderName"
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
				v-model:value="form.cardNumber"
				input-id="card-number"
				label-text="Card number"
				input-type="number"
				input-autocomplete="cc-number"
				input-mode="numeric"
				:input-max-length="24"
				:error-message="form.errors.cardNumber"
				@input="form.cardNumber = $event.target.value.slice(0, 24)"
			/>
		</div>

		<div
			class="sm:flex sm:flex-row sm:items-center sm:justify-between sm:gap-6 max-sm:space-y-6"
		>
			<div
				class="flex flex-col rounded-lg border border-skin-border bg-skin-white px-4 py-1 sm:w-2/5"
			>
				<label class="mt-1 text-xs text-skin-text-muted">Expiration date</label>
				<div class="flex w-full justify-start space-x-2">
					<input
						id="expiryMonth"
						v-model="form.expiryMonth"
						type="number"
						inputmode="numeric"
						max="12"
						placeholder="MM"
						class="w-9 rounded-lg border-none p-0 focus:ring-0"
						autocomplete="cc-exp-month"
						@input="form.expiryMonth = $event.target.value.slice(0, 2)"
					/>
					/
					<input
						id="expiryYear"
						v-model="form.expiryYear"
						type="number"
						inputmode="numeric"
						min="24"
						max="49"
						placeholder="YY"
						class="w-9 rounded-lg border-none p-0 focus:ring-0"
						autocomplete="cc-exp-year"
						@input="form.expiryYear = $event.target.value.slice(0, 2)"
					/>
				</div>

				<p
					v-if="form.errors.expiryMonth || form.errors.expiryYear"
					class="mt-2 text-sm text-skin-danger"
				>
					The expiry date is invalid
				</p>
			</div>

			<div class="flex flex-row items-center space-x-2 sm:w-3/5">
				<FloatingLabel
					v-model:value="form.cvv"
					class="w-16"
					input-id="cvv"
					label-text="CVV"
					input-type="text"
					input-autocomplete="cc-csc"
					input-mode="numeric"
					:input-max-length="3"
					:error-message="form.errors.cvv"
					@input="form.cvv = $event.target.value.slice(0, 3)"
				/>

				<img
					:src="'/images/register/payment/cvv.svg'"
					class="h-8 w-16"
				/>

				<p class="text-sm text-skin-text-muted">
					Last 3 digits on the back of the card
				</p>
			</div>
		</div>

		<div
			class="flex items-center justify-between rounded-lg bg-skin-white bg-opacity-60 px-4 py-3"
		>
			<div>
				<p class="font-bold">
					{{ subscriptionPrice }}<span class="text-xs">/month</span>
				</p>
				<p class="text-skin-text-muted">{{ subscriptionPlanName }}</p>
			</div>

			<Link
				class="font-bold text-skin-link"
				href="/pricing"
			>
				Change
			</Link>
		</div>

		<p class="mx-auto max-w-xl text-sm text-skin-text-muted">
			By clicking the "Start paid membership" button below, you agree to our
			Terms of Use and that you are over 18 and acknowledge the Privacy
			Statement. The Wordsmith's Collection will automatically continue your
			membership and charge the membership fee (currently
			{{ subscriptionPrice }}/month) to your payment method until you cancel.
			You may cancel at any time to avoid future charges.
		</p>

		<button
			type="submit"
			class="button"
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
