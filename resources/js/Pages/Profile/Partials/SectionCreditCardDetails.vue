<script setup>
import { ref } from "vue";
import { trans } from "laravel-vue-i18n";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormPayment from "@/Forms/FormPayment.vue";

defineProps({
	creditCard: {
		type: Object,
		required: true,
	},
});

const isModifying = ref(false);
</script>

<template>
	<section class="space-y-6">
		<header>
			<h2 class="font-means-web text-2xl font-bold">
				{{ trans("page.profile.credit_card.details") }}
			</h2>
		</header>

		<div>
			<h3 class="text-lg">
				{{
					trans("page.profile.credit_card.ending", {
						ending: creditCard.card_number,
					})
				}}
			</h3>
			<p>
				<span class="font-bold">{{ trans("payment.cardholder_name") }}:</span>
				{{ creditCard.cardholder_name }}
			</p>
			<p>
				<span class="font-bold">{{ trans("payment.expiration_date") }}:</span>
				{{ creditCard.expiration_month }}/{{ creditCard.expiration_year }}
			</p>
		</div>

		<button
			class="button"
			@click="isModifying = true"
		>
			{{ trans("common.action.edit") }}
		</button>

		<ModalContainer
			modal-id="modal-modify-payment-method"
			:modal-title="trans('modal.payment.edit.title')"
			:show="isModifying"
			@close="isModifying = false"
		>
			<FormPayment
				form-id="form-modify-payment-method"
				:credit-card="creditCard"
				http-method="put"
				preserve-scroll
				@success="isModifying = false"
			/>
		</ModalContainer>
	</section>
</template>
