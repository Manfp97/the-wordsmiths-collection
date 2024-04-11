<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch, computed } from "vue";
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
	category: {
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

const categoryState = computed(() => props.category);

const form = useForm({
	name: categoryState.value?.name,
	description: categoryState.value?.description,
});

watch(categoryState, (newValue) => {
	form.name = newValue?.name;
	form.description = newValue?.description;

	form.defaults({
		name: newValue?.name,
		description: newValue?.description,
	});
});

const buttonText =
	props.httpMethod === "post" ? "Add new category" : "Edit category";

const submitForm = () => {
	const url =
		props.httpMethod === "post"
			? "/category"
			: `/category/${categoryState.value?.id}`;

	form[props.httpMethod](url, {
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
		<div class="space-y-4">
			<FloatingLabel
				v-model:value="form.name"
				:input-id="`${formId}-name`"
				label-text="Name"
				input-type="text"
				input-autocomplete="off"
				is-required
				:error-message="form.errors.name"
			/>

			<FloatingTextarea
				v-model:value="form.description"
				class="sm:col-span-2"
				:textarea-id="`${formId}-description`"
				label-text="Description"
				textarea-class="min-h-[13rem]"
				is-required
				:error-message="form.errors.description"
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
