<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import Tabs from "@/Components/Common/Tabs.vue";
import FormBook from "@/Forms/FormBook.vue";
import FormAuthor from "@/Forms/FormAuthor.vue";
import FormCategory from "@/Forms/FormCategory.vue";

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
			:tabs-name="['book', 'author', 'category']"
			class="mb-4"
		/>

		<div :id="`${modalId}-tabs-content`">
			<FormBook
				:id="`${modalId}-tab-book-content`"
				class="hidden"
				role="tabpanel"
				:aria-labelledby="`${modalId}-tab-book`"
			/>
			<FormAuthor
				:id="`${modalId}-tab-author-content`"
				class="hidden"
				role="tabpanel"
				:aria-labelledby="`${modalId}-tab-author`"
				http-method="post"
			/>
			<FormCategory
				:id="`${modalId}-tab-category-content`"
				http-method="post"
				class="hidden"
				role="tabpanel"
				:aria-labelledby="`${modalId}-tab-category`"
			/>
		</div>
	</ModalContainer>
</template>
