<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
	shouldInvertIconColor: {
		type: Boolean,
		default: false,
	},
	size: {
		type: String,
		required: true,
	},
});
</script>

<template>
	<Link
		href="/"
		class="flex items-center space-x-3 rtl:space-x-reverse"
	>
		<img
			:src="'/icon.svg'"
			:class="{
				'grayscale invert': shouldInvertIconColor,
				'h-8': size === 'sm',
				'h-20': size === 'md',
			}"
			:alt="`${$page.props.appName} logo`"
		/>
		<div
			class="flex flex-col font-means-web font-semibold"
			:class="{
				'text-lg': size === 'sm',
				'text-3xl': size === 'md',
			}"
		>
			<p
				class="self-center"
				:class="{ 'leading-5': size === 'sm' }"
			>
				The Wordsmith's
			</p>
			<p
				class="self-center"
				:class="{ 'leading-3': size === 'sm' }"
			>
				Collection
			</p>
		</div>
	</Link>
</template>
