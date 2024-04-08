<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { extractKeyValuesByPattern } from "@/Helpers/arrayHelper.js";
import axios from "axios";
import DragAndDrop from "@/Components/Forms/DragAndDrop.vue";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import FloatingLabelSelectSearch from "@/Components/Forms/FloatingLabelSelectSearch.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";
import FloatingTextarea from "@/Components/Forms/FloatingTextarea.vue";
import IconPlus from "@icons/plus.svg?component";
import IconEdit from "@icons/edit.svg?component";

const emit = defineEmits(["success"]);

const props = defineProps({
	formId: {
		type: String,
		required: true,
	},
	book: {
		type: Object,
		required: false,
		default: null,
	},
	httpMethod: {
		type: String,
		required: true,
	},
	preserveScroll: {
		type: Boolean,
		required: false,
		default: true,
	},
	preserveState: {
		type: [String, Boolean],
		required: false,
		default: true,
	},
});

const form = useForm({
	title: props.book?.title,
	isbn: props.book?.isbn,
	authors_id:
		props.book?.authors.map((author) => ({
			id: author.id,
			name: `${author.first_name} ${author.last_name}`,
		})) ?? [],
	categories_id:
		props.book?.categories.map((category) => ({
			id: category.id,
			name: category.name,
		})) ?? [],
	description: props.book?.description,
	language: props.book?.language,
	page_count: props.book?.page_count,
	year: props.book?.year,
	is_premium: Boolean(props.book?.is_premium),
	book_file: props.book?.book_file,
	cover_image: props.book?.cover_image,
});

const authors = ref([]);
const categories = ref([]);

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

const buttonText = props.httpMethod === "post" ? "Add new book" : "Edit book";

const submitForm = () => {
	const url = props.httpMethod === "post" ? "/book" : `/book/${props.book?.id}`;

	form
		.transform((data) => ({
			...data,
			authors_id: data.authors_id.map((e) => e.id),
			categories_id: data.categories_id.map((e) => e.id),
		}))
		[props.httpMethod](url, {
			preserveScroll: props.preserveScroll,
			preserveState: props.preserveState,
			onSuccess: () => {
				form.reset();
				form.clearErrors();
				emit("success");
			},
		});
};
</script>

<template>
	<form
		:id="formId"
		@submit.prevent="submitForm"
	>
		<div class="grid gap-4 sm:grid-cols-2">
			<FloatingLabel
				v-model:value="form.title"
				:input-id="`${formId}-title`"
				label-text="Title"
				input-type="text"
				input-autocomplete="off"
				:error-message="form.errors.title"
			/>
			<FloatingLabel
				v-model:value="form.isbn"
				:input-id="`${formId}-isbn`"
				label-text="ISBN"
				input-type="text"
				input-autocomplete="off"
				:error-message="form.errors.isbn"
			/>

			<FloatingLabelSelectSearch
				v-model:value="form.authors_id"
				:input-id="`${formId}-author`"
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
				@click="fetchAuthors"
			/>
			<FloatingLabelSelectSearch
				v-model:value="form.categories_id"
				:input-id="`${formId}-category`"
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
				@click="fetchCategories"
			/>

			<FloatingLabel
				v-model:value="form.language"
				:input-id="`${formId}-language`"
				label-text="Language"
				input-type="text"
				input-autocomplete="off"
				input-max-length="50"
				:error-message="form.errors.language"
			/>
			<FloatingLabel
				v-model:value="form.page_count"
				:input-id="`${formId}-page-count`"
				label-text="Page count"
				input-type="number"
				input-autocomplete="off"
				:error-message="form.errors.page_count"
				@input="form.page_count = $event.target.value.slice(0, 4)"
			/>

			<FloatingLabel
				v-model:value="form.year"
				:input-id="`${formId}-year`"
				label-text="Year"
				input-type="number"
				input-autocomplete="off"
				:error-message="form.errors.year"
				@input="form.year = $event.target.value.slice(0, 4)"
			/>
			<Checkbox
				v-model:value="form.is_premium"
				:input-id="`${formId}-is-premium`"
			>
				Is it for premium subscriptions?
			</Checkbox>

			<FloatingTextarea
				v-model:value="form.description"
				class="sm:col-span-2"
				:textarea-id="`${formId}-description`"
				label-text="Description"
				textarea-class="min-h-[7rem]"
				:error-message="form.errors.description"
			/>

			<DragAndDrop
				v-model:value="form.book_file"
				:input-id="`${formId}-file-input`"
				label-text="Book file"
				:max-file-bytes="4200000"
				:supported-mime-types="['application/pdf']"
				:error-message="form.errors.book_file"
			/>
			<DragAndDrop
				v-model:value="form.cover_image"
				:input-id="`${formId}-image-input`"
				label-text="Cover image"
				:max-file-bytes="2100000"
				min-aspect-ratio-str="1/2"
				max-aspect-ratio-str="2/3"
				:supported-mime-types="['image/webp', 'image/png', 'image/jpeg']"
				:error-message="form.errors.cover_image"
			/>
		</div>

		<div class="mt-6 flex justify-end">
			<button
				type="submit"
				class="button text-sm font-bold"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				<IconPlus
					v-if="httpMethod === 'post'"
					class="mr-1 h-6 w-6"
					fill="currentColor"
				/>
				<IconEdit
					v-else-if="httpMethod === 'put'"
					class="mr-1 h-6 w-6"
				/>
				{{ buttonText }}
			</button>
		</div>
	</form>
</template>
