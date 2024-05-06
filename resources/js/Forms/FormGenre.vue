<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch, computed } from "vue";
import { trans } from "laravel-vue-i18n";
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
	genre: {
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

const genreState = computed(() => props.genre);

const form = useForm({
	name: genreState.value?.name,
	description: genreState.value?.description,
});

watch(genreState, (newValue) => {
	form.name = newValue?.name;
	form.description = newValue?.description;

	form.defaults({
		name: newValue?.name,
		description: newValue?.description,
	});
});

const buttonActionText =
	props.httpMethod === "post"
		? trans("common.action.add_new")
		: trans("common.action.edit");

const submitForm = () => {
	const url =
		props.httpMethod === "post" ? "/genre" : `/genre/${genreState.value?.id}`;

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
				:label-text="trans('genre.name')"
				input-type="text"
				input-autocomplete="off"
				is-required
				:error-message="form.errors.name"
			/>

			<FloatingTextarea
				v-model:value="form.description"
				class="sm:col-span-2"
				:textarea-id="`${formId}-description`"
				:label-text="trans('common.noun.description')"
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
				{{ trans("common.action.reset") }}
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
				{{ buttonActionText }} {{ trans("genre").toLowerCase() }}
			</button>
		</div>
	</form>
</template>
