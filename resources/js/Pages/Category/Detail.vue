<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import Footer from "@/Components/Common/Footer.vue";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormCategory from "@/Forms/FormCategory.vue";
import IconTrash from "@icons/trash.svg?component";
import IconEdit from "@icons/edit.svg?component";

defineProps({
	category: {
		type: Object,
		required: true,
	},
	bookCount: {
		type: Number,
		required: true,
	},
});

const isEditing = ref(false);
const isDeleting = ref(false);

const user = computed(() => usePage().props.auth.user);
const isAdmin = user.value?.role_id === 1;
</script>

<template>
	<AppHead
		:title="`Category ${category.name}`"
		description="Looking for more information about plans and pricing for The Wordsmith's Collection? Find all the information you need about the Basic and Premium plans."
	/>

	<Nav />

	<div class="page-container">
		<main class="mx-auto mb-20 mt-10 max-w-7xl sm:mb-32">
			<div class="mx-6 space-y-6 sm:mx-8 md:mx-10 lg:mx-12">
				<div class="flex items-center space-x-3">
					<h2 class="section-title">{{ category.name }}</h2>
					<div class="flex space-x-1.5">
						<IconTrash
							v-if="isAdmin && !category.books.length"
							class="w-6 cursor-pointer text-skin-danger md:w-8"
							@click="isDeleting = true"
						/>
						<IconEdit
							v-if="isAdmin"
							class="w-6 cursor-pointer text-skin-link md:w-8"
							@click="isEditing = true"
						/>
					</div>
				</div>

				<p class="whitespace-pre-wrap">{{ category.description }}</p>

				<div v-if="category.books.length">
					<hr class="my-4 border border-skin-border md:my-6" />

					<h3 class="mb-6 text-lg font-bold">
						{{ bookCount }} {{ category.name }} books
					</h3>
					<div class="mb-12 grid grid-cols-3 gap-6 sm:grid-cols-4">
						<BookCard
							v-for="(book, index) in category.books"
							:key="index"
							:book="book"
						/>
					</div>
				</div>
			</div>
		</main>

		<Footer />
	</div>

	<ModalContainer
		v-if="isAdmin"
		modal-id="modal-delete-category"
		modal-title="Delete category"
		:show="isDeleting"
		@close="isDeleting = false"
	>
		<div class="space-y-2">
			<p>
				Are you sure you want to delete this category? This action cannot be
				undone.
			</p>
		</div>

		<div class="mt-6 flex justify-end space-x-4">
			<button
				class="button !bg-skin-muted text-skin-white"
				@click="isDeleting = false"
			>
				No
			</button>

			<Link
				:href="`/category/${category?.id}`"
				method="delete"
				as="button"
				class="button !bg-skin-danger text-skin-white"
			>
				Yes
			</Link>
		</div>
	</ModalContainer>

	<ModalContainer
		v-if="isAdmin"
		modal-id="modal-edit-category"
		modal-title="Edit category"
		:show="isEditing"
		@close="isEditing = false"
	>
		<FormCategory
			form-id="form-edit-category"
			:category="category"
			http-method="put"
			preserve-scroll
			preserve-state="errors"
		/>
	</ModalContainer>
</template>
