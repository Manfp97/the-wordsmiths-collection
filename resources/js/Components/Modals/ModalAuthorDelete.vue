<script setup>
import { trans } from "laravel-vue-i18n";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";

const isDeleting = defineModel("value"); // eslint-disable-line
</script>

<template>
	<ModalContainer
		modal-id="modal-delete-author"
		:modal-title="trans('modal.author.delete.title')"
		:show="isDeleting"
		@close="isDeleting = false"
	>
		<div class="space-y-2">
			<p>
				{{ trans("modal.author.delete.message") }}
			</p>
		</div>

		<div class="mt-6 flex justify-end space-x-4">
			<button
				class="button !bg-skin-muted text-skin-white"
				@click="isDeleting = false"
			>
				{{ trans("modal.option.no") }}
			</button>

			<slot name="yesButton" />
		</div>
	</ModalContainer>
</template>
