import useAlerts from "@/Composables/useAlerts.js";
import {
	getFileExtensionFromMimeType,
	formatBytes,
} from "@/Helpers/fileHelper.js";

/*
fileConfig: {
	fileLabel: String,
	supportedMimeTypes: [String],
	maxFileBytes: Int,
}
*/

const { addAlert } = useAlerts();

export default function dragAndDropHelper(
	selectedFile,
	isDragOver,
	filePreview,
	fileConfig
) {
	const extensions = fileConfig.supportedMimeTypes
		.map(
			(mimeType) => `${getFileExtensionFromMimeType(mimeType).toUpperCase()}`
		)
		.join(", ");

	const handleClick = (event) => {
		handleFileInput(event.target.files[0]);
	};

	const handleDrop = (event) => {
		isDragOver.value = false;
		handleFileInput(event.dataTransfer.files[0]);
	};

	const handleFileInput = async (file) => {
		const isFileTypeValid = fileConfig.supportedMimeTypes.includes(file.type);
		const isFileSizeValid = file.size <= fileConfig.maxFileBytes;

		if (isFileTypeValid && isFileSizeValid) {
			const isAspectRatioValid =
				fileConfig.minAspectRatioStr || fileConfig.maxAspectRatioStr
					? await checkAspectRatio(
						file,
						eval(fileConfig.minAspectRatioStr).toFixed(2),
						eval(fileConfig.maxAspectRatioStr).toFixed(2)
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
				message: `File type for ${fileConfig.fieldName.toLowerCase()} not supported`,
			};

		case ErrorType.INVALID_FILE_SIZE:
			return {
				type: "danger",
				message: `The file cannot be larger than ${formatBytes(
					fileConfig.maxFileBytes
				)}`,
			};

		case ErrorType.INVALID_ASPECT_RATIO:
			return {
				type: "danger",
				message: `The image must have an aspect ratio between ${fileConfig.minAspectRatioStr} and ${fileConfig.maxAspectRatioStr}`,
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
					console.log(aspectRatio);
					console.log(maxAspectRatio);

					resolve(
						aspectRatio >= minAspectRatio && aspectRatio <= maxAspectRatio
					);
				};

				img.src = e.target.result;
			};

			reader.onerror = function () {
				reject(false);
			};

			reader.readAsDataURL(file);
		});
	};

	return {
		extensions,
		handleClick,
		handleDrop,
		openFileInput,
		removeFile,
	};
}
