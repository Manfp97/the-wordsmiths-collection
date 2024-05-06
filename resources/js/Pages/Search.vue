<script setup>
import { trans } from "laravel-vue-i18n";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import AppHead from "@/Components/Common/AppHead.vue";
import Nav from "@/Components/Common/Nav.vue";
import AuthorCard from "@/Components/Author/AuthorCard.vue";
import BookCard from "@/Components/Book/BookCard.vue";

defineProps({
	authors: {
		type: Object,
		required: true,
	},
	books: {
		type: Object,
		required: true,
	},
	query: {
		type: String,
		required: true,
	},
});
</script>

<template>
	<BaseLayout>
		<template #appHead>
			<AppHead :title="trans('common.action.search')" />
		</template>

		<template #nav>
			<Nav :query="query" />
		</template>

		<template #main>
			<div class="space-y-9 px-4 md:px-6 lg:px-16">
				<h2 class="index-title border-b border-skin-muted pb-4 font-bold">
					{{ trans("page.search.index.title", { query: query }) }}
				</h2>

				<details
					v-if="authors.data.length"
					class="space-y-3"
					open
				>
					<summary class="index-title cursor-pointer">
						{{ trans("authors") }}
					</summary>
					<div
						class="mb-12 grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 lg:gap-4 2xl:grid-cols-8"
					>
						<AuthorCard
							v-for="(author, index) in authors.data"
							:key="index"
							:author="author"
						/>
					</div>
				</details>

				<details
					v-if="books.data.length"
					class="space-y-3"
					open
				>
					<summary class="index-title cursor-pointer">
						{{ trans("books") }}
					</summary>
					<div
						class="mb-12 grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 lg:gap-4 2xl:grid-cols-8"
					>
						<BookCard
							v-for="(book, index) in books.data"
							:key="index"
							:book="book"
						/>
					</div>
				</details>
			</div>
		</template>
	</BaseLayout>
</template>
