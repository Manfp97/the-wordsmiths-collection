<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { trans, transChoice } from "laravel-vue-i18n";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import Footer from "@/Components/Common/Footer.vue";
import ModalGenreEdit from "@/Components/Modals/ModalGenreEdit.vue";
import ModalGenreDelete from "@/Components/Modals/ModalGenreDelete.vue";
import IconTrash from "@icons/trash.svg?component";
import IconEdit from "@icons/edit.svg?component";

defineProps({
	genre: {
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
	<AppHead :title="`${trans('genre')} ${genre.name.toLowerCase()}`" />

	<BaseLayout>
		<Nav />

		<div class="page-container">
			<main class="mx-auto mb-20 mt-10 max-w-7xl sm:mb-32">
				<div class="mx-6 space-y-6 sm:mx-8 md:mx-10 lg:mx-12">
					<div class="flex items-center space-x-3">
						<h2 class="section-title">{{ genre.name }}</h2>
						<div class="flex space-x-1.5">
							<IconTrash
								v-if="isAdmin && !genre.books.length"
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

					<p class="whitespace-pre-wrap">{{ genre.description }}</p>

					<div v-if="genre.books.length">
						<hr class="my-4 border border-skin-border md:my-6" />

						<h3 class="mb-6 text-lg font-bold">
							{{
								transChoice("page.genre.detail.title", bookCount, {
									count: bookCount,
									genre: genre.name,
								})
							}}
						</h3>
						<div class="mb-12 grid grid-cols-3 gap-6 sm:grid-cols-4">
							<BookCard
								v-for="(book, index) in genre.books"
								:key="index"
								:book="book"
							/>
						</div>
					</div>
				</div>
			</main>

			<Footer />
		</div>

		<ModalGenreDelete
			v-if="isAdmin"
			v-model:value="isDeleting"
		>
			<template #yesButton>
				<Link
					:href="`/genre/${genre?.id}`"
					method="delete"
					as="button"
					class="button !bg-skin-danger text-skin-white"
				>
					{{ trans("modal.option.yes") }}
				</Link>
			</template>
		</ModalGenreDelete>

		<ModalGenreEdit
			v-if="isAdmin"
			v-model:value="isEditing"
			preserve-scroll
			:genre="genre"
		/>
	</BaseLayout>
</template>
