<script setup>
import { ref } from "vue";
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
			<h2 class="font-means-web text-2xl font-bold">Credit card details</h2>
		</header>

		<div>
			<h3 class="text-lg">
				Credit card ending in {{ creditCard.card_number }}
			</h3>
			<p>
				<span class="font-bold">Cardholder name</span>:
				{{ creditCard.cardholder_name }}
			</p>
			<p>
				<span class="font-bold">Expiration date</span>:
				{{ creditCard.expiration_month }}/{{ creditCard.expiration_year }}
			</p>
		</div>

		<button
			class="button"
			@click="isModifying = true"
		>
			Modify
		</button>

		<ModalContainer
			modal-id="modal-delete-account"
			modal-title="Modify credit card details"
			:show="isModifying"
			@close="isModifying = false"
		>
			<FormPayment />
		</ModalContainer>
	</section>
</template>
