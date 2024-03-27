<script setup>
import { onMounted, ref } from "vue";
import * as pdfjsLib from "pdfjs-dist/build/pdf";
import * as pdfjsWorker from "pdfjs-dist/build/pdf.worker.mjs";
import IconXCircleFilled from "@icons/x-circle-filled.svg?component";
import IconCaretLeftFilled from "@icons/caret-left-filled.svg?component";
import IconCaretRightFilled from "@icons/caret-right-filled.svg?component";

defineEmits(["close"]);
const page = defineModel("page"); // eslint-disable-line

const props = defineProps({
	// base64 or URL
	pdfSource: {
		type: String,
		required: true,
	},
	defaultZoom: {
		type: Number,
		required: false,
		default: 150,
	},
	shouldZoomOnWheel: {
		type: Boolean,
		required: false,
		default: true,
	},
});

const currentPdf = {
	fileData: null,
	pageCount: 0,
	currentPage: page.value,
	zoom: props.defaultZoom / 100,
};

const $canvas = ref(null);
const $pageCountSpan = ref(null);
const $zoomSpan = ref(null);
const $zoomInput = ref(null);
const $textLayerDiv = ref(null);

const isPageInputFocus = ref(false);
const isZoomInputFocus = ref(false);
const zoomValue = ref(props.defaultZoom);

onMounted(() => {
	configurePdfjsWorker();
	loadPdf();
	addArrowKeysListener();
});

const configurePdfjsWorker = () => {
	pdfjsLib.GlobalWorkerOptions.workerSrc = pdfjsWorker;
};

const loadPdf = () => {
	pdfjsLib.getDocument(props.pdfSource).promise.then((pdf) => {
		currentPdf.fileData = pdf;
		currentPdf.pageCount = pdf.numPages;
		$pageCountSpan.value.innerHTML = ` of ${currentPdf.pageCount}`;
		renderPage(currentPdf.currentPage);
	});
};

const addArrowKeysListener = () => {
	document.addEventListener("keydown", (event) => {
		const key = event.key;
		const isAnyInputFocused = isZoomInputFocus.value || isPageInputFocus.value;

		if (key === "ArrowRight" && !isAnyInputFocused) {
			goToNextPage();
		} else if (key === "ArrowLeft" && !isAnyInputFocused) {
			goToPreviousPage();
		}
	});
};

// Render functions

const renderPage = (pageNumber) => {
	currentPdf.fileData.getPage(pageNumber).then((page) => {
		const context = $canvas.value.getContext("2d");
		const viewport = page.getViewport({ scale: currentPdf.zoom });

		$canvas.value.height = viewport.height;
		$canvas.value.width = viewport.width;

		page
			.render({
				canvasContext: context,
				viewport: viewport,
			})
			.promise.then(() => page.getTextContent())
			.then((textContent) => renderTextLayer(textContent, viewport));
	});

	page.value = pageNumber;
	currentPdf.currentPage = pageNumber;
};

// Credit: https://medium.com/@mxgel/enable-text-selection-on-pdf-js-32fcfe845f4b
const renderTextLayer = (textContent, viewport) => {
	// Get canvas offset
	const rect = $canvas.value.getBoundingClientRect();
	const canvasOffset = {
		top: rect.top + window.scrollY,
		left: rect.left + window.scrollX,
	};

	// Clear HTML for text layer
	$textLayerDiv.value.innerHTML = "";

	// Assign the CSS created to the text-layer element
	$textLayerDiv.value.style.setProperty("--scale-factor", viewport.scale);

	$textLayerDiv.value.style.top = `${canvasOffset.top}px`;
	$textLayerDiv.value.style.left = `${canvasOffset.left}px`;

	// Pass the data to the method for rendering of text over the pdf canvas.
	pdfjsLib.renderTextLayer({
		textContentSource: textContent,
		container: $textLayerDiv.value,
		viewport: viewport,
		textDivs: [],
	});
};

// Page manipulation functions

const goToNextPage = () => {
	const isValidPage = currentPdf.currentPage < currentPdf.pageCount;
	if (isValidPage) {
		currentPdf.currentPage += 1;
		renderPage(currentPdf.currentPage);
	}
};

const goToPreviousPage = () => {
	const isValidPage = currentPdf.currentPage - 1 > 0;
	if (isValidPage) {
		currentPdf.currentPage -= 1;
		renderPage(currentPdf.currentPage);
	}
};

const changeZoom = (newValue) => {
	if (currentPdf.fileData) {
		$zoomSpan.value.innerHTML = `${newValue}%`;
		currentPdf.zoom = parseInt(newValue) / 100;
		zoomValue.value = newValue;
		renderPage(currentPdf.currentPage);
	}
};

// Events

const onPageInputKeyUp = (event) => {
	if (event.key === "Enter" || event.keyCode === 13) {
		const value = page.value;

		if (value >= 1 && value <= currentPdf.pageCount) {
			renderPage(value);
		} else {
			page.value = currentPdf.currentPage;
		}
	}
};

const onWheel = (event) => {
	event.preventDefault();

	const deltaY = event.deltaY;
	const sign = Math.sign(-deltaY);
	const scaleFactor = 0.25;
	const newZoom = Math.round((currentPdf.zoom + sign * scaleFactor) * 100);

	const minZoom = parseInt($zoomInput.value.min);
	const maxZoom = parseInt($zoomInput.value.max);

	if (newZoom >= minZoom && newZoom <= maxZoom) {
		changeZoom(newZoom);
		$zoomInput.value.value = newZoom;
	}
};
</script>

<template>
	<div class="h-screen w-full bg-[#222]">
		<main class="w-full overflow-auto bg-[#222] p-5 pb-20">
			<canvas
				ref="$canvas"
				class="m-auto"
			>
				Your browser does not support the HTML canvas tag
			</canvas>
			<div
				ref="$textLayerDiv"
				class="text-layer"
				@wheel="shouldZoomOnWheel && onWheel($event)"
			/>
		</main>

		<footer
			class="fixed bottom-0 left-0 right-0 z-50 h-16 w-full bg-[#2d2d2d] px-4 text-skin-white sm:px-8"
		>
			<ul class="flex h-full w-full list-none items-center justify-between">
				<li class="flex grow basis-0 items-center">
					<button @click="$emit('close')">
						<IconXCircleFilled
							class="h-6 w-6 fill-skin-white hover:fill-skin-danger sm:h-7 sm:w-7"
							aria-hidden="true"
						/>
					</button>
					<span class="sr-only">Close reader</span>
				</li>

				<li class="flex items-center justify-center space-x-2">
					<button
						class="button-pagination"
						@click="goToPreviousPage"
					>
						<IconCaretLeftFilled
							class="icon-caret-size"
							aria-hidden="true"
						/>
						<span class="sr-only">Previous page</span>
					</button>

					<div>
						<input
							v-model="page"
							type="number"
							class="h-7 w-9 !p-0 text-center text-skin-text focus:border-2 focus:border-skin-secondary focus:ring-0"
							@keyup="onPageInputKeyUp"
							@focusin="isPageInputFocus = true"
							@focusout="isPageInputFocus = false"
						/>
						<span ref="$pageCountSpan" />
					</div>

					<button
						class="button-pagination"
						@click="goToNextPage"
					>
						<IconCaretRightFilled
							class="icon-caret-size"
							aria-hidden="true"
						/>
						<span class="sr-only">Next page</span>
					</button>
				</li>

				<li
					class="flex grow basis-0 items-end justify-end sm:items-center max-sm:hidden"
				>
					<span
						ref="$zoomSpan"
						class="text-xs sm:p-2.5 sm:text-sm"
					>
						{{ defaultZoom }}%
					</span>
					<input
						ref="$zoomInput"
						v-model="zoomValue"
						type="range"
						min="25"
						max="400"
						step="25"
						class="text-center"
						@input="changeZoom($event.target.value)"
						@focusin="isZoomInputFocus = true"
						@focusout="isZoomInputFocus = false"
					/>
				</li>
			</ul>
		</footer>
	</div>
</template>

<style scoped>
.button-pagination {
	@apply inline-flex h-7 w-7 items-center justify-center rounded-full bg-skin-secondary font-bold text-skin-text hover:bg-skin-secondary-offset;
}

.icon-caret-size {
	@apply h-5 w-5;
}

.text-layer {
	@apply absolute inset-0 z-[2] origin-[0_0] overflow-hidden leading-none opacity-25;
}

.text-layer ::selection {
	@apply bg-[#00f] text-skin-transparent;
}

/* https://vue-loader.vuejs.org/guide/scoped-css.html#deep-selectors */
.text-layer :deep(br),
.text-layer :deep(span) {
	@apply absolute origin-[0_0] cursor-text whitespace-pre text-skin-transparent;
}

.text-layer :deep(br::selection) {
	background: 0 0;
}
</style>
