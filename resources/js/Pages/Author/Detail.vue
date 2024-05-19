<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { trans, transChoice } from "laravel-vue-i18n";
import { getFormattedDate } from "@/Helpers/stringHelper.js";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import Footer from "@/Components/Common/Footer.vue";
import ModalAuthorDelete from "@/Components/Modals/ModalAuthorDelete.vue";
import ModalAuthorEdit from "@/Components/Modals/ModalAuthorEdit.vue";
import IconTrash from "@icons/trash.svg?component";
import IconEdit from "@icons/edit.svg?component";

const props = defineProps({
	author: {
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

const fullName = `${props.author.first_name} ${props.author.last_name ?? ""}`;

const formattedBirthDate = getFormattedDate(props.author.birth_date);
const formattedDeathDate = getFormattedDate(props.author.death_date);

const responsivePortrait = props.author.responsive_portrait?.replaceAll(
	">",
	"class='rounded'>"
);
</script>

<template>
	<AppHead :title="fullName" />

	<BaseLayout>
		<Nav />

		<div class="page-container">
			<main class="mx-auto mb-20 mt-10 max-w-7xl sm:mb-32">
				<div class="mx-6 sm:mx-8 md:mx-10 lg:mx-12">
					<div class="md:grid md:grid-cols-6 lg:grid-cols-12 max-md:space-y-10">
						<!-- Left column -->
						<div class="md:col-span-2 lg:col-span-3">
							<div class="sticky top-24 mx-auto w-full">
								<!-- eslint-disable vue/no-v-html -->
								<div
									v-if="author.responsive_portrait"
									class="[&>*]:mx-auto"
									v-html="responsivePortrait"
								/>
								<img
									v-else
									:src="`/images/author/placeholder.png`"
									:alt="`Placeholder image for ${fullName}`"
									class="rounded"
								/>
								<!-- eslint-enable -->
							</div>
						</div>

						<!-- Right column -->
						<div class="md:col-span-4 md:ml-8 lg:col-span-9 lg:ml-14">
							<section>
								<div class="flex items-center space-x-3">
									<h2 class="section-title">{{ fullName }}</h2>
									<div class="flex space-x-1.5">
										<IconTrash
											v-if="isAdmin && !author.books.length"
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

								<p class="my-4 whitespace-pre-wrap">{{ author.description }}</p>

								<div
									v-if="author.genres.length"
									class="mt-3 flex items-center space-x-4"
								>
									<span class="text-skin-muted">
										{{ transChoice("genre.count", author.genres.length) }}
									</span>
									<Link
										v-for="(genre, index) in author.genres"
										:key="index"
										:href="`/genre/${genre.slug}`"
										class="font-bold underline decoration-skin-secondary decoration-[3px] underline-offset-4 hover:decoration-skin-tertiary"
									>
										{{ genre.name }}
									</Link>
								</div>

								<div class="mt-4 grid w-fit grid-cols-2 gap-10">
									<div class="text-skin-muted">
										<p>{{ trans("page.author.detail.born") }}</p>
										<p>{{ trans("page.author.detail.died") }}</p>
									</div>

									<div>
										<p>{{ formattedBirthDate }}</p>
										<p>{{ formattedDeathDate }}</p>
									</div>
								</div>
							</section>

							<div v-if="author.books.length">
								<hr class="my-4 border border-skin-border md:my-6" />

								<h3 class="mb-6 flex justify-between text-lg font-bold">
									{{
										transChoice("page.author.detail.written_by", bookCount, {
											count: bookCount,
											author: fullName,
										})
									}}
								</h3>
								<section class="mb-12 grid grid-cols-3 gap-6 sm:grid-cols-4">
									<BookCard
										v-for="(book, index) in author.books"
										:key="index"
										:book="book"
									/>
								</section>
							</div>
						</div>
					</div>
				</div>
			</main>

			<Footer />
		</div>

		<ModalAuthorDelete
			v-if="isAdmin"
			v-model:value="isDeleting"
		>
			<template #yesButton>
				<Link
					:href="`/author/${author?.id}`"
					method="delete"
					as="button"
					class="button !bg-skin-danger text-skin-white"
				>
					{{ trans("modal.option.yes") }}
				</Link>
			</template>
		</ModalAuthorDelete>

		<ModalAuthorEdit
			v-if="isAdmin"
			v-model:value="isEditing"
			:preserve-scroll="true"
			:author="author"
		/>
	</BaseLayout>
</template>
