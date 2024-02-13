<script setup>
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormReview from "@/Forms/FormReview.vue";

defineProps({
	modalId: {
		type: String,
		required: false,
		default: "modal-review",
	},
	modalTitle: {
		type: String,
		required: false,
		default: "Write a review",
	},
});
</script>

<template>
	<ModalContainer
		:modal-id="modalId"
		:modal-title="modalTitle"
	>
		<FormReview />
	</ModalContainer>
</template>
