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
	bookId: {
		type: Number,
		required: true,
	},
});

const emit = defineEmits(["close"]);

const emitClose = () => emit("close");
</script>

<template>
	<ModalContainer
		:modal-id="modalId"
		:modal-title="modalTitle"
		@close="emitClose"
	>
		<FormReview :book-id="bookId" />
	</ModalContainer>
</template>
