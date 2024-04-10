<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch, computed } from "vue";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";
import IconPlus from "@icons/plus.svg?component";
import IconEdit from "@icons/edit.svg?component";
import IconReset from "@icons/reset.svg?component";

const emit = defineEmits(["success"]);

const props = defineProps({
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
	first_name: null,
	last_name: null,
});

watch(authorState, (newValue) => {
	form.first_name = newValue?.first_name;
	form.last_name = newValue?.last_name;

	form.defaults({
		first_name: newValue?.first_name,
		last_name: newValue?.last_name,
	});
});

const buttonText =
	props.httpMethod === "post" ? "Add new author" : "Edit author";

const submitForm = () => {
	const url =
		props.httpMethod === "post"
			? "/author"
			: `/author/${authorState.value?.id}`;

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
	<form @submit.prevent="submitForm">
		<div class="grid gap-4 sm:grid-cols-2">
			<FloatingLabel
				v-model:value="form.first_name"
				input-id="author-first-name"
				label-text="First name"
				input-type="text"
				input-autocomplete="off"
				is-required
				:error-message="form.errors.first_name"
			/>
			<FloatingLabel
				v-model:value="form.last_name"
				input-id="author-last-name"
				label-text="Last name"
				input-type="text"
				input-autocomplete="off"
				is-required
				:error-message="form.errors.last_name"
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
