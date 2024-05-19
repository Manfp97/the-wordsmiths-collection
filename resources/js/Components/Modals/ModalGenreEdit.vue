<script setup>
import { trans } from "laravel-vue-i18n";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormGenre from "@/Forms/FormGenre.vue";

const isEditing = defineModel("value"); // eslint-disable-line

defineProps({
	preserveScroll: {
		type: Boolean,
		required: true,
	},
	genre: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<ModalContainer
		modal-id="modal-edit-genre"
		:modal-title="trans('modal.genre.edit.title')"
		:show="isEditing"
		@close="isEditing = false"
	>
		<FormGenre
			form-id="form-edit-genre"
			:genre="genre"
			http-method="put"
			:preserve-scroll="preserveScroll"
			preserve-state="errors"
		/>
	</ModalContainer>
</template>
