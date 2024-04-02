<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch, computed } from "vue";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import IconPlus from "@icons/plus.svg?component";
import IconEdit from "@icons/edit.svg?component";

const props = defineProps({
	category: {
		type: Object,
		required: false,
		default: null,
	},
	httpMethod: {
		type: String,
		required: true,
	},
});

const categoryState = computed(() => props.category);

const form = useForm({
	name: categoryState.value?.name,
});

watch(categoryState, () => {
	form.name = categoryState.value?.name;
});

const buttonText =
	props.httpMethod === "post" ? "Add new category" : "Edit category";

const submitForm = () => {
	const url =
		props.httpMethod === "post"
			? "/category"
			: `/category/${categoryState.value?.id}`;

	form[props.httpMethod](url, {
		preserveScroll: true,
		onSuccess: () => {
			form.reset();
			form.clearErrors();
		},
	});
};
</script>

<template>
	<form @submit.prevent="submitForm">
		<FloatingLabel
			v-model:value="form.name"
			input-id="category-name"
			label-text="Name"
			input-type="text"
			input-autocomplete="off"
			:error-message="form.errors.name"
		/>

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
