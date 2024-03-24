<script setup>
import IconX from "@icons/x.svg?component";
import { computed, onMounted, onUnmounted, watch } from "vue";

const props = defineProps({
	modalId: {
		type: String,
		required: true,
	},
	modalTitle: {
		type: String,
		required: false,
		default: null,
	},
	show: {
		type: Boolean,
		required: false,
		default: false,
	},
	shouldShowHeaderBorder: {
		type: Boolean,
		required: false,
		default: true,
	},
	maxWidth: {
		type: String,
		required: false,
		default: "2xl",
	},
	closeable: {
		type: Boolean,
		required: false,
		default: true,
	},
});

const emit = defineEmits(["close"]);

watch(
	() => props.show,
	() => {
		if (props.show) {
			document.body.style.overflow = "hidden";
		} else {
			document.body.style.overflow = null;
		}
	}
);

const close = () => {
	if (props.closeable) {
		emit("close");
	}
};

const closeOnEscape = (e) => {
	if (e.key === "Escape" && props.show) {
		close();
	}
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));

onUnmounted(() => {
	document.removeEventListener("keydown", closeOnEscape);
	document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
	return {
		sm: "sm:max-w-sm",
		md: "sm:max-w-md",
		lg: "sm:max-w-lg",
		xl: "sm:max-w-xl",
		"2xl": "sm:max-w-2xl",
	}[props.maxWidth];
});
</script>

<template>
	<Teleport to="body">
		<Transition leave-active-class="duration-200">
			<div
				v-show="show"
				:id="modalId"
				tabindex="-1"
				:aria-hidden="show"
				class="fixed inset-0 z-50 overflow-y-auto overflow-x-hidden px-4 py-6 sm:px-0"
				scroll-region
			>
				<Transition
					enter-active-class="ease-out duration-300"
					enter-from-class="opacity-0"
					enter-to-class="opacity-100"
					leave-active-class="ease-in duration-200"
					leave-from-class="opacity-100"
					leave-to-class="opacity-0"
				>
					<div
						v-show="show"
						class="fixed inset-0 transform transition-all"
						@click="close"
					>
						<div class="absolute inset-0 bg-skin-muted opacity-75" />
					</div>
				</Transition>

				<Transition
					enter-active-class="ease-out duration-300"
					enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
					enter-to-class="opacity-100 translate-y-0 sm:scale-100"
					leave-active-class="ease-in duration-200"
					leave-from-class="opacity-100 translate-y-0 sm:scale-100"
					leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				>
					<div
						v-show="show"
						class="mb-6 transform overflow-hidden rounded-lg bg-skin-primary shadow-xl transition-all sm:mx-auto sm:w-full"
						:class="maxWidthClass"
					>
						<!-- Modal header -->
						<div
							class="mx-4 flex items-center justify-between rounded-t py-4 md:mx-5 md:py-5"
							:class="{
								'border-b border-skin-border': shouldShowHeaderBorder,
							}"
						>
							<h3
								v-if="modalTitle"
								class="text-xl font-semibold"
							>
								{{ modalTitle }}
							</h3>
							<button
								v-show="closeable"
								type="button"
								class="ml-auto rounded-full border border-skin-border p-1 text-sm text-skin-muted hover:bg-skin-danger hover:text-skin-white"
								@click="close"
							>
								<IconX
									aria-hidden="true"
									class="h-5 w-5"
									fill="currentColor"
								/>
								<span class="sr-only">Close modal</span>
							</button>
						</div>

						<!-- Modal body -->
						<div
							:class="{
								'p-4 md:p-5': shouldShowHeaderBorder,
								'px-4 pb-4 md:px-5 md:pb-5': !shouldShowHeaderBorder,
							}"
						>
							<slot />
						</div>
					</div>
				</Transition>
			</div>
		</Transition>
	</Teleport>
</template>
