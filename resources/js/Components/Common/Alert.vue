<script setup>
import { computed, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
import useAlerts from "@/Composables/useAlerts";
import IconX from "@icons/x.svg?component";
import IconCheckCircleFilled from "@icons/check-circle-filled.svg?component";
import IconAlertCircleFilled from "@icons/alert-circle-filled.svg?component";
import IconXCircleFilled from "@icons/x-circle-filled.svg?component";

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
				class="fixed bottom-0 right-0 z-[99] mr-4 w-full max-w-xs max-sm:left-1/2 max-sm:-translate-x-1/2 max-sm:transform"
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
						class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded text-skin-white"
					>
						<IconCheckCircleFilled
							v-if="alert.type === 'success'"
							class="h-8 w-8 text-skin-success"
							aria-hidden="true"
							fill="currentColor"
						/>
						<IconXCircleFilled
							v-else-if="alert.type === 'danger'"
							class="h-8 w-8 text-skin-danger"
							aria-hidden="true"
							fill="currentColor"
						/>
						<IconAlertCircleFilled
							v-else-if="alert.type === 'warning'"
							class="h-8 w-8 text-skin-warning"
							aria-hidden="true"
							fill="currentColor"
						/>

						<span class="sr-only">{{ alert.type }} icon</span>
					</div>
					<div class="ms-3 text-sm font-normal">{{ alert.message }}</div>
					<button
						type="button"
						class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg p-1.5 hover:rounded-lg hover:fill-skin-white"
						:class="{
							'hover:bg-skin-success': alert.type === 'success',
							'hover:bg-skin-warning': alert.type === 'warning',
							'hover:bg-skin-danger': alert.type === 'danger',
						}"
						:data-dismiss-target="`toast-${alert.type}-${index}`"
						:aria-label="trans('common.action.close')"
						@click="removeAlert(alert.id, (isImmediate = true))"
					>
						<IconX
							class="h-6 w-6"
							aria-hidden="true"
						/>
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
