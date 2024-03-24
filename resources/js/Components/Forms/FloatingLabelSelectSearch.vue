<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from "vue";
import IconSearch from "@icons/search.svg?component";

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

const selectedOptions = defineModel("value"); // eslint-disable-line

const isDropdownVisible = ref(false);
const areAnyItemsSelected = ref(false);
const $selectedItemsList = ref(null);
const $dropdownSearch = ref(null);
const $dropdownSearchButton = ref(null);
const searchText = ref("");

let observer = null;

onMounted(() => {
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
		}
	}
);

const deselectAllCheckboxes = () => {
	props.options.forEach((option) => {
		const checkboxId = `${props.inputId}-${option.id}`;
		const $checkbox = document.getElementById(checkboxId);

		if ($checkbox?.checked) {
			$checkbox.checked = false;
		}
	});

	$selectedItemsList.value.innerHTML = "";
	areAnyItemsSelected.value = false;
};

const filteredOptions = computed(() => {
	const searchLowerCase = searchText.value.toLowerCase();

	return props.options.filter((option) =>
		option.name.toLowerCase().includes(searchLowerCase)
	);
});

const handleCheckboxChange = (event) => {
	const elementId = event.target.id;
	const elementIdSplit = elementId.split("-");
	const valueId = parseInt(elementIdSplit[elementIdSplit.length - 1]);

	if (event.target.checked) {
		const $newLiElement = document.createElement("li");
		const valueLabelText = document.querySelector(
			`label[for="${elementId}"]`
		).textContent;
		$newLiElement.textContent = valueLabelText;
		$newLiElement.classList.add(
			"bg-skin-secondary",
			"px-2",
			"text-sm",
			"py-1",
			"rounded"
		);
		$newLiElement.id = `li-${elementId}`;
		selectedOptions.value.push(valueId);

		$selectedItemsList.value.appendChild($newLiElement);
	} else {
		document.getElementById(`li-${elementId}`).remove();

		var index = selectedOptions.value.indexOf(valueId);
		if (index !== -1) {
			selectedOptions.value.splice(index, 1);
		}
	}

	areAnyItemsSelected.value = selectedOptions.value.length > 0;
};
</script>

<template>
	<div class="relative">
		<div
			:id="`${inputId}-dropdown-search-button`"
			ref="$dropdownSearchButton"
			:data-dropdown-toggle="`${inputId}-dropdown-search`"
			data-dropdown-placement="bottom"
			class="z-0 flex min-h-[3.25rem] w-full cursor-pointer flex-col rounded-lg border border-skin-border bg-skin-white px-4 shadow-sm"
			:class="{
				'border-skin-secondary outline-none ring-2 ring-skin-secondary':
					isDropdownVisible,
			}"
		>
			<label
				:for="inputId"
				class="absolute cursor-pointer select-none text-sm text-skin-text"
				:class="{
					'top-4': !areAnyItemsSelected,
					'top-3': areAnyItemsSelected,
				}"
			>
				{{ labelText }}
			</label>

			<ul
				:id="`${inputId}-selected-values`"
				ref="$selectedItemsList"
				class="mb-3 mt-10 flex flex-wrap gap-2"
			></ul>
		</div>

		<div
			v-if="successMessages"
			class="mt-2 px-2 text-xs text-skin-success"
		>
			<p
				v-for="(successMessage, index) in successMessages"
				:key="index"
				v-text="successMessage.value"
			/>
		</div>

		<div
			v-if="errorMessages"
			class="mt-2 px-2 text-xs text-skin-danger"
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
							class="h-4 w-4 text-skin-text-muted"
							aria-hidden="true"
							fill="none"
						/>
					</div>
					<input
						:id="`${inputId}-input-group-search`"
						v-model="searchText"
						type="text"
						class="block w-full rounded-lg border border-skin-border bg-skin-primary-offset p-2 ps-10 text-sm focus:border-skin-secondary focus:ring-skin-secondary"
						:placeholder="`Search ${labelText.toLowerCase()}...`"
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
