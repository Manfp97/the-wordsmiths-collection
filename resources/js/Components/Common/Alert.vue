<script setup>
import { computed, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import useAlerts from "@/Composables/useAlerts";

const receivedAlert = computed(() => usePage().props.flash.alert);
const { addAlert, removeAlert, alerts } = useAlerts();

watch(receivedAlert, (newVal) => {
	if (newVal) {
		addAlert(newVal);
	}
});
</script>

<template>
	<Teleport to="body">
		<Transition>
			<div
				v-if="alerts.length"
				class="fixed bottom-0 right-0 z-50 mr-4 w-full max-w-xs max-sm:left-1/2 max-sm:-translate-x-1/2 max-sm:transform"
			>
				<div
					v-for="(alert, index) in alerts"
					:id="`toast-${alert.type}-${index}`"
					:key="index"
					class="mb-4 flex items-center rounded border-2 p-3.5 shadow"
					:class="{
						'border-skin-success bg-skin-success-light':
							alert.type === 'success',
						'border-skin-warning bg-skin-warning-light':
							alert.type === 'warning',
						'border-skin-danger bg-skin-danger-light': alert.type === 'danger',
					}"
					role="alert"
				>
					<div
						class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded text-white"
					>
						<svg
							v-if="alert.type === 'success'"
							class="h-8 w-8 text-skin-success"
							aria-hidden="true"
							xmlns="http://www.w3.org/2000/svg"
							fill="currentColor"
							viewBox="0 0 20 20"
						>
							<path
								d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
							/>
						</svg>

						<svg
							v-if="alert.type === 'danger'"
							class="h-8 w-8 text-skin-danger"
							aria-hidden="true"
							xmlns="http://www.w3.org/2000/svg"
							fill="currentColor"
							viewBox="0 0 20 20"
						>
							<path
								d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"
							/>
						</svg>

						<svg
							v-if="alert.type === 'warning'"
							class="h-8 w-8 text-skin-warning"
							aria-hidden="true"
							xmlns="http://www.w3.org/2000/svg"
							fill="currentColor"
							viewBox="0 0 20 20"
						>
							<path
								d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"
							/>
						</svg>

						<span class="sr-only">{{ alert.type }} icon</span>
					</div>
					<div class="ms-3 text-sm font-normal">{{ alert.message }}</div>
					<button
						type="button"
						class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg p-1.5 text-skin-text-muted hover:rounded-lg hover:bg-skin-primary hover:text-skin-danger"
						:data-dismiss-target="`toast-${alert.type}-${index}`"
						aria-label="Close"
						@click="removeAlert(alert.id, (isImmediate = true))"
					>
						<span class="sr-only">Close</span>
						<svg
							class="h-3 w-3"
							aria-hidden="true"
							xmlns="http://www.w3.org/2000/svg"
							fill="none"
							viewBox="0 0 14 14"
						>
							<path
								stroke="currentColor"
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
							/>
						</svg>
					</button>
				</div>
			</div>
		</Transition>
	</Teleport>
</template>

<style scoped>
.v-enter-active,
.v-leave-active {
	transition: opacity 0.25s ease;
}

.v-enter-from,
.v-leave-to {
	opacity: 0;
}
</style>
