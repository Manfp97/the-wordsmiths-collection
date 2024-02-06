export const isImage = (fileMimeType) => {
	return fileMimeType.startsWith("image/");
};

export const formatBytes = (bytes, decimals = 1) => {
	if (!+bytes) return "0 Bytes";

	const k = 1024;
	const dm = decimals < 0 ? 0 : decimals;
	const sizes = ["Bytes", "KB", "MB"];

	const i = Math.floor(Math.log(bytes) / Math.log(k));

	return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
};

export const getFileExtensionFromMimeType = (mimeType) => {
	const extensionMapping = {
		"image/jpeg": "jpg",
		"image/png": "png",
		"image/webp": "webp",
		"application/pdf": "pdf",
		// Add more content type mappings as needed
	};

	// Attempt to get the extension from the mapping, default to 'dat' if not found
	return extensionMapping[mimeType] || "dat";
};
