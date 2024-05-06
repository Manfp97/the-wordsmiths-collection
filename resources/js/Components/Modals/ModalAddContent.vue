<script setup>
import { onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
import { initFlowbite } from "flowbite";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import Tabs from "@/Components/Common/Tabs.vue";
import FormBook from "@/Forms/FormBook.vue";
import FormAuthor from "@/Forms/FormAuthor.vue";
import FormGenre from "@/Forms/FormGenre.vue";

const modalId = "modal-add-content";
const tabs = [
	{ id: "book", text: trans("book") },
	{ id: "author", text: trans("author") },
	{ id: "genre", text: trans("genre") },
];

onMounted(() => {
	initFlowbite();
});
</script>

<template>
	<ModalContainer
		:modal-id="modalId"
		:modal-title="trans('modal.add_content.title')"
		:should-show-header-border="false"
	>
		<Tabs
			:parent-id="modalId"
			:tabs="tabs"
			class="mb-4"
		/>

		<!-- <Tabs
			:parent-id="modalId"
			:tabs-name="['book', 'author', 'genre']"
			class="mb-4"
		/> -->

		<div :id="`${modalId}-tabs-content`">
			<FormBook
				:form-id="`${modalId}-tab-book-content`"
				class="hidden"
				role="tabpanel"
				:aria-labelledby="`${modalId}-tab-book`"
				http-method="post"
				:preserve-state="usePage().component !== 'Book/Index'"
			/>
			<FormAuthor
				:form-id="`${modalId}-tab-author-content`"
				class="hidden"
				role="tabpanel"
				:aria-labelledby="`${modalId}-tab-author`"
				http-method="post"
				:preserve-state="usePage().component !== 'Author/Index'"
			/>
			<FormGenre
				:form-id="`${modalId}-tab-genre-content`"
				http-method="post"
				class="hidden"
				role="tabpanel"
				:aria-labelledby="`${modalId}-tab-genre`"
				:preserve-state="usePage().component !== 'Index'"
			/>
		</div>
	</ModalContainer>
</template>
