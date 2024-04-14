<script setup>
defineProps({
	links: {
		type: Array,
		required: true,
	},
});

const linkLabel = (label) => {
	return label.includes("Previous")
		? "Previous page"
		: label.includes("Next")
			? "Next page"
			: `page ${label}`;
};

const prevNext = (label) => {
	return label.includes("Previous")
		? "First page (no previous page available)"
		: "Last page (no next page available)";
};
</script>

<template>
	<nav aria-label="Pagination">
		<template
			v-for="(link, index) in links"
			:key="index"
		>
			<!-- eslint-disable vue/no-v-text-v-html-on-component vue/no-v-html -->
			<Link
				v-if="link.url"
				:href="link.url"
				:aria-label="linkLabel(link.label)"
				:aria-current="link.active"
				:class="{
					'font-bold': link.active,
					'pr-4': index === 0,
					'pl-4': index === links.length - 1,
					'px-1': index > 0 && index < links.length - 1,
				}"
				preserve-scroll
				v-html="link.label"
			/>
			<span
				v-else
				:aria-label="prevNext(link.label)"
				class="text-skin-muted"
				:class="{
					'pr-4': index === 0,
					'pl-4': index === links.length - 1,
				}"
				v-html="link.label"
			/>
		</template>
	</nav>
</template>
