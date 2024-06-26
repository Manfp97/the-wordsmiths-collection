<script setup>
import { ref } from "vue";
import {
	isImage,
	formatBytes,
	getFileExtensionFromMimeType,
} from "@/Helpers/fileHelper.js";
import { trans } from "laravel-vue-i18n";
import useAlerts from "@/Composables/useAlerts.js";
import IconX from "@icons/x.svg?component";
import IconCloudUpload from "@icons/cloud-upload.svg?component";

const selectedFile = defineModel("value"); // eslint-disable-line

const props = defineProps({
	inputId: {
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
	isRequired: {
		type: Boolean,
		required: false,
		default: false,
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

const { addAlert } = useAlerts();

const $fileInput = ref(null);
const isDragOver = ref(false);
const filePreview = ref(null);

const extensions = props.supportedMimeTypes
	.map((mimeType) => `${getFileExtensionFromMimeType(mimeType).toUpperCase()}`)
	.join(", ");

const handleClick = (event) => {
	handleFileInput(event.target.files[0]);
};

const handleDrop = (event) => {
	isDragOver.value = false;
	handleFileInput(event.dataTransfer.files[0]);
};

const handleFileInput = async (file) => {
	const isFileTypeValid = props.supportedMimeTypes.includes(file.type);
	const isFileSizeValid = file.size <= props.maxFileBytes;

	if (isFileTypeValid && isFileSizeValid) {
		const isAspectRatioValid =
			props.minAspectRatioStr || props.maxAspectRatioStr
				? await checkAspectRatio(
					file,
					eval(props.minAspectRatioStr).toFixed(2),
					eval(props.maxAspectRatioStr).toFixed(2)
				)
				: true;

		if (isAspectRatioValid) {
			uploadFile(file);
		} else {
			addAlert(getErrorMessage(ErrorType.INVALID_ASPECT_RATIO));
		}
	} else {
		if (!isFileTypeValid) {
			addAlert(getErrorMessage(ErrorType.INVALID_FILE_TYPE));
		} else if (!isFileSizeValid) {
			addAlert(getErrorMessage(ErrorType.INVALID_FILE_SIZE));
		}
	}
};

const ErrorType = {
	INVALID_FILE_TYPE: "invalidFileType",
	INVALID_FILE_SIZE: "invalidFileSize",
	INVALID_ASPECT_RATIO: "invalidAspectRatio",
};

const getErrorMessage = (errorType) => {
	switch (errorType) {
	case ErrorType.INVALID_FILE_TYPE:
		return {
			type: "danger",
			message: trans("component.drag_and_drop.error.invalid_file_type"),
		};

	case ErrorType.INVALID_FILE_SIZE:
		return {
			type: "danger",
			message: trans("component.drag_and_drop.error.invalid_file_size", {
				size: formatBytes(props.maxFileBytes),
			}),
		};

	case ErrorType.INVALID_ASPECT_RATIO:
		return {
			type: "danger",
			message: trans("component.drag_and_drop.error.invalid_aspect_ratio", {
				min: props.minAspectRatioStr,
				max: props.maxAspectRatioStr,
			}),
		};
	}
};

const openFileInput = ($fileInput) => {
	$fileInput.click();
};

const uploadFile = (file) => {
	const reader = new FileReader();
	reader.onload = () => {
		selectedFile.value = file;
		filePreview.value = reader.result;
	};
	reader.readAsDataURL(file);
};

const removeFile = () => {
	selectedFile.value = null;
	filePreview.value = null;
};

const checkAspectRatio = (file, minAspectRatio, maxAspectRatio) => {
	return new Promise((resolve, reject) => {
		const reader = new FileReader();

		reader.onload = function (e) {
			const img = new Image();

			img.onload = function () {
				const aspectRatio = img.width / img.height;

				resolve(aspectRatio >= minAspectRatio && aspectRatio <= maxAspectRatio);
			};

			img.src = e.target.result;
		};

		reader.onerror = function () {
			reject(false);
		};

		reader.readAsDataURL(file);
	});
};
</script>

<template>
	<div>
		<div class="rounded-lg shadow-sm">
			<label
				:for="inputId"
				class="mb-2 inline-flex w-full justify-between font-medium"
				@click.prevent
			>
				<span class="text-sm">
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
				</span>
				<button
					v-if="selectedFile"
					:title="trans('component.drag_and_drop.remove_file')"
					:aria-title="trans('component.drag_and_drop.remove_file')"
					class="text-skin-muted"
					@click="removeFile"
				>
					<IconX
						aria-hidden="true"
						class="h-5 w-5 hover:text-skin-danger"
						fill="currentColor"
					/>
				</button>
			</label>
			<div
				class="flex min-h-[9.25rem] w-full flex-col items-center justify-center rounded-lg border-2 border-skin-border bg-skin-white focus-visible:border-skin-secondary focus-visible:outline-none"
				:class="{
					'border-dashed hover:bg-skin-secondary-offset': !selectedFile,
					'': selectedFile,
					'bg-skin-secondary-offset': isDragOver && !selectedFile,
				}"
				tabindex="0"
				@dragover.prevent="isDragOver = true"
				@dragleave.prevent="isDragOver = false"
				@drop.prevent="handleDrop"
				@keydown.enter.prevent="if (!selectedFile) openFileInput($fileInput);"
			>
				<div
					v-if="!selectedFile"
					class="flex h-full w-full cursor-pointer flex-col items-center justify-center pb-6 pt-5"
					@click="openFileInput($fileInput)"
				>
					<IconCloudUpload
						class="mb-4 h-8 w-8 text-skin-muted"
						aria-hidden="true"
						fill="none"
					/>

					<!-- eslint-disable vue/no-v-html -->
					<p
						class="mb-2 text-sm text-skin-muted"
						v-html="trans('component.drag_and_drop.message')"
					/>
					<!-- eslint-enable -->

					<p class="text-xs text-skin-muted">
						{{ extensions }} (max. {{ formatBytes(maxFileBytes) }})
					</p>
					<p
						v-if="minAspectRatioStr && maxAspectRatioStr"
						class="text-xs text-skin-muted"
					>
						{{ trans("component.drag_and_drop.aspect_ratio") }}: min.
						{{ minAspectRatioStr }}, max.
						{{ maxAspectRatioStr }}
					</p>
					<input
						:id="inputId"
						ref="$fileInput"
						type="file"
						class="hidden"
						:accept="supportedMimeTypes.join(',')"
						:required="isRequired"
						@change="handleClick"
					/>
				</div>
				<div
					v-else
					class="flex h-full w-full flex-col items-center justify-center px-3 py-2"
				>
					<img
						v-if="isImage(selectedFile.type)"
						:src="selectedFile.url || filePreview"
						alt="Preview"
						class="mb-2 max-h-20 max-w-full"
					/>
					<p class="max-w-full break-words text-sm">
						{{ selectedFile.name }}
					</p>
					<p class="text-xs text-skin-muted sm:text-sm">
						{{ formatBytes(selectedFile.size) }}
					</p>
				</div>
			</div>
		</div>

		<p
			v-if="successMessage"
			:id="`${inputId}-success`"
			class="mt-2 px-2 text-xs text-skin-success"
		>
			{{ successMessage }}
		</p>
		<p
			v-if="errorMessage"
			:id="`${inputId}-error`"
			class="mt-2 px-2 text-xs text-skin-danger"
		>
			{{ errorMessage }}
		</p>
	</div>
</template>
