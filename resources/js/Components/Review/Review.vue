<script setup>
import Rating from "@/Components/Common/Rating.vue";
import IconUserCircle from "@icons/user-circle.svg?component";

const props = defineProps({
	review: {
		type: Object,
		required: true,
	},
});

const date = new Date(props.review.date);
const formattedDate = date.toLocaleString("default", {
	day: "numeric",
	month: "long",
	year: "numeric",
});
</script>

<template>
	<article>
		<div class="mb-2 flex items-center">
			<div class="me-4 h-10 w-10 rounded-full bg-skin-card">
				<IconUserCircle
					class="text-skin-white"
					fill="none"
				/>
			</div>
			<div>
				{{ review.username }}
			</div>
		</div>
		<div class="mb-1 flex items-center">
			<Rating
				:rating="review.rating"
				icon-class="h-4 w-4"
				:editable="false"
			/>

			<!-- <h3 class="ms-3 text-sm font-semibold">
				{{ review.title }}
			</h3> -->
		</div>

		<footer class="mb-3 text-sm text-skin-text-muted">
			<p>
				Reviewed on
				<time :datetime="props.review.date">{{ formattedDate }}</time>
			</p>
		</footer>

		<p class="mb-2">
			{{ review.reviewText }}
		</p>
	</article>
</template>
