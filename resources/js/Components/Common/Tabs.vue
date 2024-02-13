<script setup>
import { capitalized } from "@/Helpers/stringHelper.js";

defineProps({
	parentId: {
		type: String,
		required: true,
	},
	tabsName: {
		type: Array,
		required: true,
	},
});
</script>

<template>
	<div class="border-b border-skin-border">
		<nav
			class="flex space-x-2"
			aria-label="Tabs"
			role="tablist"
			:data-tabs-toggle="`#${parentId}-tabs-content`"
		>
			<button
				v-for="tabName in tabsName"
				:id="`${parentId}-tab-${tabName}`"
				:key="tabName"
				type="button"
				class="inline-block rounded-t-lg border border-b-2 border-skin-transparent px-4 py-2.5 hover:border-skin-border aria-selected:border-skin-secondary aria-selected:bg-skin-secondary aria-selected:bg-opacity-40 aria-selected:font-bold aria-selected:text-skin-text"
				:data-tabs-target="`#${parentId}-tab-${tabName}-content`"
				:aria-controls="`${parentId}-tab-${tabName}-content`"
				role="tab"
			>
				{{ capitalized(tabName) }}
			</button>
		</nav>
	</div>
</template>
