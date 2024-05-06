<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
import { useIntersectionObserver } from "@vueuse/core";
import axios from "axios";
import IndexLayout from "@//Layouts/IndexLayout.vue";
import SwiperSection from "@/Components/Swiper/SwiperSection.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormAuthor from "@/Forms/FormAuthor.vue";
import IconTrash from "@icons/trash.svg?component";
import IconEdit from "@icons/edit.svg?component";

const props = defineProps({
	authors: {
		type: Object,
		required: true,
	},
});

const swiperBreakpoints = {
	0: {
		slidesPerView: 3,
		spaceBetween: 8,
	},
	640: {
		slidesPerView: 4,
		spaceBetween: 8,
	},
	768: {
		slidesPerView: 5,
		spaceBetween: 8,
	},
	1024: {
		slidesPerView: 6,
		spaceBetween: 16,
	},
	1536: {
		slidesPerView: 8,
		spaceBetween: 16,
	},
};

const $infiniteScrollingOffset = ref(null);
const authorsState = ref({
	data: props.authors.data,
	meta: props.authors.meta,
});

const selectedAuthor = ref(null);
const isDeleting = ref(false);
const isEditing = ref(false);

const user = computed(() => usePage().props.auth.user);
const isAdmin = user.value?.role_id === 1;

const { stop } = useIntersectionObserver(
	$infiniteScrollingOffset,
	([{ isIntersecting }]) => {
		if (!isIntersecting) {
			return;
		}

		const meta = authorsState.value.meta;
		if (meta.next_cursor) {
			axios.get(`${meta.path}?cursor=${meta.next_cursor}`).then((response) => {
				authorsState.value.data = [
					...authorsState.value.data,
					...response.data.data,
				];
				authorsState.value.meta = response.data.meta;
			});
		} else {
			stop();
		}
	}
);

const askToDeleteAuthor = (author) => {
	selectedAuthor.value = author;
	isDeleting.value = true;
};

const askToEditAuthor = (author) => {
	selectedAuthor.value = author;
	isEditing.value = true;
};
</script>

<template>
	<IndexLayout>
		<template #main>
			<SwiperSection
				v-for="(author, indexAuthor) in authorsState.data"
				:key="indexAuthor"
				:breakpoints="swiperBreakpoints"
			>
				<template #header>
					<div
						class="mb-4 flex items-center space-x-6 px-4 md:mb-6 md:px-6 lg:px-16"
					>
						<h2 class="index-title font-bold underline hover:text-skin-link">
							<Link :href="`/author/${author.slug}`">
								{{ author.first_name }} {{ author.last_name }}
							</Link>
						</h2>
						<div class="flex space-x-1.5">
							<!-- Allow deletion of authors without books only -->
							<IconTrash
								v-if="isAdmin && !author.books.length"
								class="w-6 cursor-pointer text-skin-danger md:w-8"
								@click="askToDeleteAuthor(author)"
							/>
							<IconEdit
								v-if="isAdmin"
								class="w-6 cursor-pointer text-skin-link md:w-8"
								@click="askToEditAuthor(author)"
							/>
						</div>
					</div>
				</template>

				<swiper-slide
					v-for="(book, indexBook) in author.books"
					:key="indexBook"
					class="my-1 h-auto"
				>
					<BookCard :book="book" />
				</swiper-slide>
			</SwiperSection>
		</template>

		<template #modals>
			<ModalContainer
				v-if="isAdmin"
				modal-id="modal-delete-author"
				:modal-title="trans('modal.author.delete.title')"
				:show="isDeleting"
				@close="isDeleting = false"
			>
				<div class="space-y-2">
					<p>{{ trans("modal.author.delete.message") }}</p>
				</div>

				<div class="mt-6 flex justify-end space-x-4">
					<button
						class="button !bg-skin-muted text-skin-white"
						@click="isDeleting = false"
					>
						{{ trans("modal.option.no") }}
					</button>

					<Link
						:href="`/author/${selectedAuthor?.id}`"
						method="delete"
						as="button"
						class="button !bg-skin-danger text-skin-white"
						:preserve-state="false"
						preserve-scroll
						@click="isDeleting = false"
					>
						{{ trans("modal.option.yes") }}
					</Link>
				</div>
			</ModalContainer>

			<ModalContainer
				v-if="isAdmin"
				modal-id="modal-edit-author"
				:modal-title="trans('modal.author.edit.title')"
				:show="isEditing"
				@close="isEditing = false"
			>
				<FormAuthor
					form-id="author-edit"
					:author="selectedAuthor"
					http-method="put"
					:preserve-scroll="false"
					preserve-state="errors"
				/>
			</ModalContainer>
		</template>
	</IndexLayout>
</template>
