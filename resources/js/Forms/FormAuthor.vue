<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch, computed } from "vue";
import DragAndDrop from "@/Components/Forms/DragAndDrop.vue";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import FloatingTextarea from "@/Components/Forms/FloatingTextarea.vue";
import IconPlus from "@icons/plus.svg?component";
import IconEdit from "@icons/edit.svg?component";
import IconReset from "@icons/reset.svg?component";

const emit = defineEmits(["success"]);

const props = defineProps({
	formId: {
		type: String,
		required: true,
	},
	author: {
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

const authorState = computed(() => props.author);

const form = useForm({
	first_name: props.author?.first_name,
	last_name: props.author?.last_name,
	description: props.author?.description,
	portrait_file: props.author?.portrait_file,
});

watch(authorState, (newValue) => {
	form.first_name = newValue?.first_name;
	form.last_name = newValue?.last_name;
	form.description = newValue?.description;
	form.portrait_file = newValue?.portrait_file;

	form.defaults({
		first_name: newValue?.first_name,
		last_name: newValue?.last_name,
		description: newValue?.description,
		portrait_file: newValue?.portrait_file,
	});
});

const buttonText =
	props.httpMethod === "post" ? "Add new author" : "Edit author";

const submitForm = () => {
	const url =
		props.httpMethod === "post"
			? "/author"
			: `/author/${authorState.value?.id}`;

	form
		.transform((data) => {
			return {
				...data,
				portrait_file: data.portrait_file?.lastModifiedDate
					? data.portrait_file
					: null,
				_method: props.httpMethod,
			};
		})
		.post(url, {
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
				v-model:value="form.first_name"
				:input-id="`${formId}-first-name`"
				label-text="First name"
				input-type="text"
				input-autocomplete="off"
				is-required
				:error-message="form.errors.first_name"
			/>
			<FloatingLabel
				v-model:value="form.last_name"
				:input-id="`${formId}-last-name`"
				label-text="Last name"
				input-type="text"
				input-autocomplete="off"
				:error-message="form.errors.last_name"
			/>

			<FloatingTextarea
				v-model:value="form.description"
				class="sm:col-span-2"
				:textarea-id="`${formId}-description`"
				label-text="Description"
				textarea-class="min-h-[7rem]"
				is-required
				:error-message="form.errors.description"
			/>

			<DragAndDrop
				v-model:value="form.portrait_file"
				:input-id="`${formId}-portrait-file`"
				label-text="Author portrait"
				:max-file-bytes="2100000"
				:supported-mime-types="['image/webp', 'image/png', 'image/jpeg']"
				class="sm:col-span-2"
			/>
		</div>

		<div class="mt-6 flex justify-end space-x-4">
			<button
				type="button"
				class="button bg-skin-muted text-sm font-bold text-skin-white"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
				@click="form.reset()"
			>
				<IconReset class="mr-1 h-6 w-6" />
				Reset form
			</button>

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
