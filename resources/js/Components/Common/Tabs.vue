<script setup>
defineProps({
	parentId: {
		type: String,
		required: true,
	},
	tabs: {
		type: Array[Object],
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
				v-for="(tab, index) in tabs"
				:id="`${parentId}-tab-${tab.text}`"
				:key="index"
				type="button"
				class="inline-block rounded-t-lg border border-b-2 border-skin-transparent px-4 py-2.5 hover:border-skin-border aria-selected:border-skin-secondary aria-selected:bg-skin-secondary aria-selected:bg-opacity-40 aria-selected:font-bold aria-selected:text-skin-text"
				:data-tabs-target="`#${parentId}-tab-${tab.id}-content`"
				:aria-controls="`${parentId}-tab-${tab.id}-content`"
				role="tab"
			>
				{{ tab.text }}
			</button>
		</nav>
	</div>
</template>
