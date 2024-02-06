<script setup>
import { ref } from "vue";
import { isImage, formatBytes } from "@/Helpers/fileHelper.js";
import dragAndDropHelper from "@/Helpers/dragAndDropHelper.js";

const props = defineProps({
	id: {
		type: String,
		required: true,
	},
	labelText: {
		type: String,
		required: true,
	},
	maxFileBytes: {
		type: Number,
		required: true,
	},
	supportedMimeTypes: {
		type: Array,
		required: true,
	},
	minAspectRatioStr: {
		type: String,
		required: false,
		default: null,
	},
	maxAspectRatioStr: {
		type: String,
		required: false,
		default: null,
	},
	successMessage: {
		type: String,
		required: false,
		default: null,
	},
	errorMessage: {
		type: String,
		required: false,
		default: null,
	},
});

const selectedFile = defineModel("value"); // eslint-disable-line

const $fileInput = ref(null);
const isDragOver = ref(false);
const filePreview = ref(null);

const { extensions, handleClick, handleDrop, openFileInput, removeFile } =
	dragAndDropHelper(selectedFile, isDragOver, filePreview, {
		fieldName: props.labelText,
		maxFileBytes: props.maxFileBytes,
		supportedMimeTypes: props.supportedMimeTypes,
		minAspectRatioStr: props.minAspectRatioStr,
		maxAspectRatioStr: props.maxAspectRatioStr,
	});
</script>

<template>
	<div>
		<div>
			<label
				:for="id"
				class="mb-2 inline-flex w-full justify-between font-medium"
				@click.prevent
			>
				<span class="text-sm">{{ labelText }}</span>
				<button
					v-if="selectedFile"
					title="Remove file"
					aria-title="Remove file"
					class="text-skin-text-muted"
					@click="removeFile"
				>
					<svg
						aria-hidden="true"
						class="h-5 w-5 hover:text-skin-danger"
						fill="currentColor"
						viewBox="0 0 20 20"
						xmlns="http://www.w3.org/2000/svg"
					>
						<path
							fill-rule="evenodd"
							d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
							clip-rule="evenodd"
						/>
					</svg>
				</button>
			</label>
			<div
				class="flex min-h-[9.25rem] w-full flex-col items-center justify-center rounded-lg border-2 border-skin-border bg-skin-primary-offset"
				:class="{
					'border-dashed hover:bg-skin-secondary-offset': !selectedFile,
					'': selectedFile,
					'bg-skin-secondary-offset': isDragOver && !selectedFile,
				}"
				@dragover.prevent="isDragOver = true"
				@dragleave.prevent="isDragOver = false"
				@drop.prevent="handleDrop"
			>
				<div
					v-if="!selectedFile"
					class="flex h-full w-full cursor-pointer flex-col items-center justify-center pb-6 pt-5"
					@click="openFileInput($fileInput)"
				>
					<svg
						class="mb-4 h-8 w-8 text-skin-text-muted"
						aria-hidden="true"
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 20 16"
					>
						<path
							stroke="currentColor"
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
						/>
					</svg>
					<p class="mb-2 text-sm text-skin-text-muted">
						<strong>Click to upload</strong> or <strong>drag and drop</strong>
					</p>
					<p class="text-xs text-skin-text-muted">
						{{ extensions }} (max. {{ formatBytes(maxFileBytes) }})
					</p>
					<p
						v-if="minAspectRatioStr && maxAspectRatioStr"
						class="text-xs text-skin-text-muted"
					>
						Aspect ratio: min. {{ minAspectRatioStr }}, max.
						{{ maxAspectRatioStr }}
					</p>
					<input
						:id="id"
						ref="$fileInput"
						type="file"
						class="hidden"
						:accept="supportedMimeTypes.join(',')"
						@change="handleClick"
					/>
				</div>
				<div
					v-else
					class="flex h-full w-full flex-col items-center justify-center px-3 py-2"
				>
					<img
						v-if="isImage(selectedFile.type)"
						:src="filePreview"
						alt="Preview"
						class="mb-2 max-h-20 max-w-full"
					/>
					<p class="max-w-full break-words text-sm">
						{{ selectedFile.name }}
					</p>
					<p class="text-xs text-skin-text-muted sm:text-sm">
						{{ formatBytes(selectedFile.size) }}
					</p>
				</div>
			</div>
		</div>

		<p
			v-if="successMessage"
			:id="`${id}-success`"
			class="mt-2 px-2 text-xs text-skin-success"
		>
			{{ successMessage }}
		</p>
		<p
			v-if="errorMessage"
			:id="`${id}-error`"
			class="mt-2 px-2 text-xs text-skin-danger"
		>
			{{ errorMessage }}
		</p>
	</div>
</template>
