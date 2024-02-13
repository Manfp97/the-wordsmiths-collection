<script setup>
import IconX from "@icons/x.svg?component";

defineProps({
	modalId: {
		type: String,
		required: true,
	},
	modalTitle: {
		type: String,
		required: false,
		default: null,
	},
	shouldShowHeaderBorder: {
		type: Boolean,
		required: false,
		default: true,
	},
});
</script>

<template>
	<Teleport to="body">
		<div
			:id="modalId"
			tabindex="-1"
			aria-hidden="true"
			class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
		>
			<div class="relative max-h-full w-full max-w-2xl p-4">
				<!-- Modal content -->
				<div class="relative rounded-lg bg-skin-primary shadow">
					<!-- Modal header -->
					<div
						class="mx-4 flex items-center justify-between rounded-t py-4 md:mx-5 md:py-5"
						:class="{ 'border-b border-skin-border': shouldShowHeaderBorder }"
					>
						<h3
							v-if="modalTitle"
							class="text-xl font-semibold"
						>
							{{ modalTitle }}
						</h3>
						<button
							type="button"
							class="ml-auto rounded-full border border-skin-border p-1 text-sm text-skin-text-muted hover:bg-skin-danger hover:text-skin-white"
							:data-modal-hide="modalId"
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
			</div>
		</div>
	</Teleport>
</template>
