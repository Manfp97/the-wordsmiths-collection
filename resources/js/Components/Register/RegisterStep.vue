<script setup>
defineProps({
	stepNumber: {
		type: String,
		required: true,
	},
	stepName: {
		type: String,
		required: true,
	},
	stepNamePosition: {
		type: String,
		required: true,
	},
	url: {
		type: String,
		required: false,
		default: null,
	},
	isDone: {
		type: Boolean,
		required: false,
		default: false,
	},
	isSelected: {
		type: Boolean,
		required: false,
		default: false,
	},
});
</script>

<template>
	<li class="relative text-left">
		<Link
			v-if="url"
			class="common"
			:class="{
				'ring ring-skin-card ring-offset-2': isSelected,
				'bg-skin-card': isDone,
			}"
			:href="url"
		>
			{{ stepNumber }}
		</Link>

		<span
			v-if="!url"
			class="common select-none bg-skin-border"
		>
			{{ stepNumber }}
		</span>

		<span
			class="absolute mt-2 text-skin-text-muted"
			:class="stepNamePosition"
		>
			{{ stepName }}
		</span>
	</li>
</template>

<style scoped>
.common {
	@apply flex h-5 w-5 items-center justify-center rounded-full text-xs font-semibold text-white;
}
</style>
