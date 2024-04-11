<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import Tabs from "@/Components/Common/Tabs.vue";
import FormBook from "@/Forms/FormBook.vue";
import FormAuthor from "@/Forms/FormAuthor.vue";
import FormGenre from "@/Forms/FormGenre.vue";

const modalId = "modal-add-content";

onMounted(() => {
	initFlowbite();
});
</script>

<template>
	<ModalContainer
		:modal-id="modalId"
		modal-title="What do you want to add?"
		:should-show-header-border="false"
	>
		<Tabs
			:parent-id="modalId"
			:tabs-name="['book', 'author', 'genre']"
			class="mb-4"
		/>

		<div :id="`${modalId}-tabs-content`">
			<FormBook
				:form-id="`${modalId}-tab-book-content`"
				class="hidden"
				role="tabpanel"
				:aria-labelledby="`${modalId}-tab-book`"
				http-method="post"
			/>
			<FormAuthor
				:form-id="`${modalId}-tab-author-content`"
				class="hidden"
				role="tabpanel"
				:aria-labelledby="`${modalId}-tab-author`"
				http-method="post"
			/>
			<FormGenre
				:form-id="`${modalId}-tab-genre-content`"
				http-method="post"
				class="hidden"
				role="tabpanel"
				:aria-labelledby="`${modalId}-tab-genre`"
			/>
		</div>
	</ModalContainer>
</template>
