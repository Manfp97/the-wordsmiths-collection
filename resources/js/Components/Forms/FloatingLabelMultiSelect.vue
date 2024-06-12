<script setup>
// Taken and modified from: https://flowbite.com/docs/components/dropdowns/#dropdown-with-search
import { ref, computed, onMounted, onUnmounted, watch } from "vue";
import { trans } from "laravel-vue-i18n";
import IconSearch from "@icons/search.svg?component";
import IconTrash from "@icons/trash.svg?component";
import IconChevronDown from "@icons/chevron-down.svg?component";

const selectedOptions = defineModel("value"); // eslint-disable-line

const props = defineProps({
	inputId: {
		type: String,
		required: true,
	},
	labelText: {
		type: String,
		required: true,
	},
	// Array of objects with `id` and `name` attributes
	options: {
		type: Array,
		required: true,
	},
	isRequired: {
		type: Boolean,
		required: false,
		default: false,
	},
	// Array of objects with `key`, `value`, and `index` attributes
	successMessages: {
		type: Array,
		required: false,
		default: null,
	},
	// Array of objects with `key`, `value`, and `index` attributes
	errorMessages: {
		type: Array,
		required: false,
		default: null,
	},
});

const isDropdownVisible = ref(false);
const areAnyItemsSelected = computed(() => selectedOptions.value.length > 0);
const $selectedItemsList = ref(null);
const $dropdownSearch = ref(null);
const $dropdownSearchButton = ref(null);
const searchText = ref("");

let observer = null;

onMounted(() => {
	loadSelectedElements();

	observer = new MutationObserver(() => {
		isDropdownVisible.value =
			!$dropdownSearch.value.classList.contains("hidden");
	});

	observer.observe($dropdownSearch.value, { attributes: true });
});

onUnmounted(() => observer && observer.disconnect());

watch(
	() => selectedOptions.value,
	(newValue) => {
		if (newValue.length === 0) {
			deselectAllCheckboxes();
		} else {
			$selectedItemsList.value.innerHTML = "";
			loadSelectedElements();
		}
	}
);

const onTrashClick = (e) => {
	if (!isDropdownVisible.value) {
		e.stopPropagation();
	}

	selectedOptions.value = [];
	selectedOptions.value.length = 0; // = [] is not enough to change the value
};

const deselectAllCheckboxes = () => {
	props.options.forEach((option) => {
		const checkboxId = `${props.inputId}-${option.id}`;
		const $checkbox = document.getElementById(checkboxId);

		if ($checkbox?.checked) {
			$checkbox.checked = false;
		}
	});

	$selectedItemsList.value.innerHTML = "";
};

const filteredOptions = computed(() => {
	const searchLowerCase = searchText.value.toLowerCase();

	return props.options.filter((option) =>
		option.name.toLowerCase().includes(searchLowerCase)
	);
});

const loadSelectedElements = () => {
	selectedOptions.value.forEach((option) => {
		createElement(`${props.inputId}-${option.id}`, option.name);
	});
};

const createElement = (elementId, textContent) => {
	const $newLiElement = document.createElement("li");
	$newLiElement.textContent = textContent;
	$newLiElement.classList.add(
		"bg-skin-secondary",
		"px-2",
		"text-sm",
		"py-1",
		"rounded"
	);
	$newLiElement.id = `li-${elementId}`;
	$selectedItemsList.value.appendChild($newLiElement);
};

const handleCheckboxChange = (event) => {
	const elementId = event.target.id;
	const elementIdSplit = elementId.split("-");
	const valueId = parseInt(elementIdSplit[elementIdSplit.length - 1]);

	if (event.target.checked) {
		const valueLabelText = document.querySelector(
			`label[for="${elementId}"]`
		).textContent;
		createElement(elementId, valueLabelText);
		selectedOptions.value.push({
			id: valueId,
			name: valueLabelText,
		});
	} else {
		document.getElementById(`li-${elementId}`).remove();

		for (let i = 0; i < selectedOptions.value.length; i++) {
			if (selectedOptions.value[i].id === valueId) {
				selectedOptions.value.splice(i, 1);
				i--; // Decrement i to account for the removed element
			}
		}
	}
};
</script>

<template>
	<div
		class="relative rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-skin-secondary"
		tabindex="0"
		@keydown.enter.prevent="$dropdownSearchButton.click()"
		@keydown.esc.stop="$dropdownSearchButton.click()"
	>
		<div
			:id="`${inputId}-dropdown-search-button`"
			ref="$dropdownSearchButton"
			:data-dropdown-toggle="`${inputId}-dropdown-search`"
			data-dropdown-placement="bottom"
			class="z-0 flex h-full min-h-[3.25rem] w-full cursor-pointer flex-col rounded-lg border border-skin-border bg-skin-white px-4 shadow-sm focus:ring-2"
			:class="{
				'outline-none ring-2': isDropdownVisible,
				'border-skin-secondary ring-skin-secondary':
					isDropdownVisible && !successMessages && !errorMessages,
				'ring-skin-success': isDropdownVisible && successMessages,
				'ring-skin-danger': isDropdownVisible && errorMessages,
				'border-skin-success': successMessages,
				'border-skin-danger': errorMessages,
			}"
		>
			<div
				class="absolute flex w-full justify-between pr-6"
				:class="{
					'top-4': !areAnyItemsSelected,
					'top-3': areAnyItemsSelected,
				}"
			>
				<label
					:for="inputId"
					class="cursor-pointer select-none text-sm text-skin-text"
				>
					{{ labelText }}
					<span
						v-if="isRequired"
						class="text-skin-danger"
					>
						*
					</span>
					<span
						v-else
						class="text-skin-muted"
					>
						{{ trans("components.forms.optional") }}
					</span>
				</label>

				<IconTrash
					v-if="areAnyItemsSelected"
					class="w-5 stroke-skin-danger"
					@click="onTrashClick"
				/>
				<IconChevronDown
					v-else
					class="w-5 text-skin-muted"
				/>
			</div>

			<ul
				:id="`${inputId}-selected-values`"
				ref="$selectedItemsList"
				class="mb-3 mt-10 flex flex-wrap gap-2"
			></ul>
		</div>

		<div
			v-if="successMessages"
			class="-ml-1 mt-2 px-2 text-xs text-skin-success"
		>
			<p
				v-for="(successMessage, index) in successMessages"
				:key="index"
				v-text="successMessage.value"
			/>
		</div>

		<div
			v-if="errorMessages"
			class="-ml-2 mt-2 px-2 text-xs text-skin-danger"
		>
			<p
				v-for="(errorMessage, index) in errorMessages"
				:key="index"
				v-text="errorMessage.value"
			/>
		</div>

		<div
			:id="`${inputId}-dropdown-search`"
			ref="$dropdownSearch"
			class="absolute z-10 mt-2 hidden w-full rounded-lg border border-skin-border bg-skin-primary-offset shadow"
		>
			<div class="p-3">
				<label
					:for="`${inputId}-input-group-search`"
					class="sr-only"
				>
					Search
				</label>
				<div class="relative">
					<div
						class="rtl:inset-r-0 pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3"
					>
						<IconSearch
							class="h-4 w-4 text-skin-muted"
							aria-hidden="true"
							fill="none"
						/>
					</div>
					<input
						:id="`${inputId}-input-group-search`"
						v-model="searchText"
						type="text"
						class="block w-full rounded-lg border border-skin-border bg-skin-primary-offset p-2 ps-10 text-sm focus:border-skin-secondary focus:ring-skin-secondary"
						:placeholder="`${trans(
							'common.action.search'
						)} ${labelText.toLowerCase()}...`"
					/>
				</div>
			</div>
			<ul
				class="max-h-48 overflow-y-auto px-3 pb-3 text-sm"
				:aria-label="`${inputId}-dropdown-search-button`"
			>
				<li
					v-for="(option, index) in filteredOptions"
					:key="index"
				>
					<div
						class="flex cursor-pointer items-center rounded ps-2 hover:bg-skin-primary"
					>
						<input
							:id="`${inputId}-${option.id}`"
							type="checkbox"
							:value="option.id"
							class="h-4 w-4 cursor-pointer rounded border-skin-border bg-gray-100 text-skin-secondary focus:ring-2 focus:ring-skin-secondary"
							:checked="selectedOptions.some((e) => e.id === option.id)"
							@change="handleCheckboxChange"
						/>
						<label
							:for="`${inputId}-${option.id}`"
							class="ms-2 w-full cursor-pointer select-none rounded py-2 text-sm font-medium"
						>
							{{ option.name }}
						</label>
					</div>
				</li>
			</ul>
		</div>
	</div>
</template>

<style scoped>
::-webkit-scrollbar-track {
	@apply bg-skin-primary-offset;
}

::-webkit-scrollbar {
	@apply w-2;
}
</style>
