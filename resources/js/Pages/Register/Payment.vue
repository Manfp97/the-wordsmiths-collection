<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import FloatingLabel from "@/Components/Common/FloatingLabel.vue";
import RegisterLayout from "@/Layouts/RegisterLayout.vue";
import { ref } from "vue";

const subscriptionPlan = {
	name: "Basic",
	price: 4.99,
	currency: "€",
	features: [
		{
			isCheck: true,
			text: "Write reviews",
		},
		{
			isCheck: true,
			text: "Read <span class='font-bold'>Basic</span> books",
		},
	],
};

const cvv = ref(null);
const expiryMonth = ref(null);
const expiryYear = ref(null);

const stringPrice = `${subscriptionPlan.currency}${subscriptionPlan.price}`;
</script>

<template>
	<AppHead
		title="Payment"
		description="Complete the payment to The Wordsmith's Collection to start reading a vast library of the greatest works of literature."
	/>

	<RegisterLayout
		:header-title="'Secure payment info'"
		:subscription-plan="subscriptionPlan"
		:current-step="3"
	>
		<form
			class="space-y-6"
			action="#"
		>
			<FloatingLabel
				:id="'cardholderName'"
				label-text="Name on card"
				:type="'text'"
				:autocomplete="'cc-name'"
			/>

			<div>
				<span
					class="mb-2 flex flex-row space-x-2"
					aria-label="We accept Visa, Mastercard and American Express."
				>
					<img
						:src="'/images/register/payment/VISA.png'"
						alt="Visa"
						class="h-6"
						:srcset="'/images/register/payment/VISA@2x.png 2x'"
						data-uia="logoIcon-VISA"
					/>
					<img
						:src="'/images/register/payment/MASTERCARD.png'"
						alt="Mastercard"
						class="h-6"
						:srcset="'/images/register/payment/MASTERCARD.png 2x'"
					/>
					<img
						:src="'/images/register/payment/AMEX.png'"
						alt="American Express"
						class="h-6"
						:srcset="'/images/register/payment/AMEX@2x.png 2x'"
					/>
				</span>

				<FloatingLabel
					:id="'cardNumber'"
					label-text="Card number"
					:type="'number'"
					:autocomplete="'cc-number'"
					inputmode="numeric"
					maxlength="24"
				/>
			</div>

			<div
				class="sm:flex sm:flex-row sm:items-center sm:justify-between sm:gap-6 max-sm:space-y-6"
			>
				<div
					class="flex flex-col rounded-lg border border-skin-border bg-skin-primary-offset px-2.5 py-1 sm:w-2/5"
				>
					<label class="text-sm text-skin-text-muted">Expiration date</label>
					<div>
						<input
							id="expiryMonth"
							v-model="expiryMonth"
							type="number"
							inputmode="numeric"
							max="12"
							placeholder="MM"
							class="w-16 rounded-lg border-none bg-skin-primary-offset py-0"
							autocomplete="cc-exp-month"
							@input="(event) => (expiryMonth = event.target.value.slice(0, 2))"
						/>
						/
						<input
							id="expiryYear"
							v-model="expiryYear"
							type="number"
							inputmode="numeric"
							min="24"
							max="49"
							placeholder="YY"
							class="w-16 rounded-lg border-none bg-skin-primary-offset py-0"
							autocomplete="cc-exp-year"
							@input="(event) => (expiryYear = event.target.value.slice(0, 2))"
						/>
					</div>
				</div>

				<div class="flex flex-row items-center space-x-2 sm:w-3/5">
					<FloatingLabel
						:id="'cvv'"
						v-model:value="cvv"
						class="w-16"
						label-text="CVV"
						:type="'text'"
						:autocomplete="'cc-csc'"
						inputmode="numeric"
						maxlength="3"
						@input="cvv = cvv.slice(0, 3)"
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
				class="flex items-center justify-between rounded-lg bg-white bg-opacity-60 px-4 py-3"
			>
				<div>
					<p class="font-bold">
						{{ stringPrice }}<span class="text-xs">/month</span>
					</p>
					<p class="text-skin-text-muted">{{ subscriptionPlan.name }}</p>
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
				{{ stringPrice }}/month) to your payment method until you cancel. You
				may cancel at any time to avoid future charges.
			</p>

			<Link
				href="/register/confirmation#form"
				class="my-2 flex items-center justify-center rounded-md bg-skin-secondary py-3 font-bold hover:bg-skin-secondary-offset"
			>
				Start paid membership
				<svg
					xmlns="http://www.w3.org/2000/svg"
					class="ml-4 h-4 w-4"
					fill="none"
					viewBox="0 0 24 24"
					stroke="currentColor"
					stroke-width="2"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						d="M14 5l7 7m0 0l-7 7m7-7H3"
					/>
				</svg>
			</Link>
		</form>
	</RegisterLayout>
</template>
