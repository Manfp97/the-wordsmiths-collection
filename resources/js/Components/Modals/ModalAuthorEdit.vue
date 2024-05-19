<script setup>
import { trans } from "laravel-vue-i18n";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormAuthor from "@/Forms/FormAuthor.vue";

const isEditing = defineModel("value"); // eslint-disable-line

defineProps({
	preserveScroll: {
		type: Boolean,
		required: true,
	},
	author: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<ModalContainer
		modal-id="modal-edit-author"
		:modal-title="trans('modal.author.edit.title')"
		:show="isEditing"
		@close="isEditing = false"
	>
		<FormAuthor
			form-id="author-edit"
			:author="author"
			http-method="put"
			:preserve-scroll="preserveScroll"
			preserve-state="errors"
		/>
	</ModalContainer>
</template>
