<script setup>
import { ref, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import { extractKeyValuesByPattern } from "@/Helpers/arrayHelper.js";
import axios from "axios";
import DragAndDrop from "@/Components/Forms/DragAndDrop.vue";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import FloatingLabelSelectSearch from "@/Components/Forms/FloatingLabelSelectSearch.vue";
import IconPlus from "@icons/plus.svg?component";

const authors = ref([]);
const categories = ref([]);

const form = useForm({
	title: null,
	isbn: null,
	authors_id: [],
	categories_id: [],
	book_file: null,
	cover_image: null,
});

const fetchAuthors = async () => {
	try {
		const response = await axios.get("/api/authors?order_by=first_name");
		authors.value = response.data["data"].map((author) => {
			const id = author.id;
			const name = `${author.first_name} ${author.last_name}`;

			return { id, name };
		});
	} catch (error) {
		console.error("Error fetching data:", error);
	}
};

const fetchCategories = async () => {
	try {
		const response = await axios.get("/api/categories?order_by=name");
		categories.value = response.data["data"].map((category) => {
			const id = category.id;
			const name = category.name;

			return { id, name };
		});
	} catch (error) {
		console.error("Error fetching data:", error);
	}
};

onMounted(() => {
	fetchAuthors();
	fetchCategories();
});

const submitForm = () => {
	form.post("/book", {
		onSuccess: () => {
			form.reset();
			form.clearErrors();
		},
	});
};
</script>

<template>
	<form @submit.prevent="submitForm">
		<div class="grid gap-4 sm:grid-cols-2">
			<FloatingLabel
				v-model:value="form.title"
				input-id="book-title"
				label-text="Title"
				input-type="text"
				input-autocomplete="off"
				:error-message="form.errors.title"
			/>
			<FloatingLabel
				v-model:value="form.isbn"
				input-id="book-isbn"
				label-text="ISBN"
				input-type="text"
				input-autocomplete="off"
				:error-message="form.errors.isbn"
			/>

			<FloatingLabelSelectSearch
				v-model:value="form.authors_id"
				input-id="book-author"
				label-text="Author"
				:options="authors"
				:error-messages="
					extractKeyValuesByPattern(
						form.errors,
						'authors_id',
						(splitBy = '.'),
						(atIndex = 1)
					)
				"
			/>
			<FloatingLabelSelectSearch
				v-model:value="form.categories_id"
				input-id="book-category"
				label-text="Category"
				:options="categories"
				:error-messages="
					extractKeyValuesByPattern(
						form.errors,
						'categories_id',
						(splitBy = '.'),
						(atIndex = 1)
					)
				"
			/>

			<DragAndDrop
				v-model:value="form.book_file"
				input-id="book-file-input"
				label-text="Book file"
				:max-file-bytes="4200000"
				:supported-mime-types="['application/pdf']"
				:error-message="form.errors.book_file"
			/>
			<DragAndDrop
				v-model:value="form.cover_image"
				input-id="cover-image-input"
				label-text="Cover image"
				:max-file-bytes="2100000"
				min-aspect-ratio-str="1/2"
				max-aspect-ratio-str="2/3"
				:supported-mime-types="['image/webp', 'image/png', 'image/jpeg']"
				:error-message="form.errors.cover_image"
			/>
		</div>

		<div class="mt-6 flex justify-center">
			<button
				type="submit"
				class="hover:bg-primary-800 focus:ring-primary-300 inline-flex items-center rounded-lg !bg-skin-secondary px-5 py-2.5 text-center text-sm font-bold focus:outline-none"
				:disabled="form.processing"
			>
				<IconPlus
					class="-ml-1 mr-1 h-6 w-6"
					fill="currentColor"
				/>
				Add new book
			</button>
		</div>
	</form>
</template>
