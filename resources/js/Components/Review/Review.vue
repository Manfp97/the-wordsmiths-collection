<script setup>
import { getFormattedDate } from "@/Helpers/stringHelper.js";
import Rating from "@/Components/Common/Rating.vue";
import IconUserCircle from "@icons/user-circle.svg?component";
import IconTrash from "@icons/trash.svg?component";
import IconEdit from "@icons/edit.svg?component";

const emit = defineEmits(["edit", "delete"]);

const props = defineProps({
	bookId: {
		type: Number,
		required: true,
	},
	review: {
		type: Object,
		required: true,
	},
});

const formattedDate = getFormattedDate(props.review.created_at, {
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

		<footer class="mb-3 text-sm text-skin-muted">
			<p>
				Reviewed on
				<time :datetime="props.review.created_at">{{ formattedDate }}</time>
			</p>
		</footer>

		<p class="mb-2 whitespace-pre-wrap">
			{{ review.review_text }}
		</p>

		<div
			v-if="review.can_edit || review.can_delete"
			class="flex space-x-4"
		>
			<button
				v-if="review.can_delete"
				class="common-options text-skin-danger"
				@click="emit('delete')"
			>
				<IconTrash class="mr-1 w-4" />
				Delete
			</button>

			<button
				v-if="review.can_edit"
				class="common-options text-skin-link"
				@click="emit('edit')"
			>
				<IconEdit class="mr-1 w-4" />
				Edit
			</button>
		</div>
	</article>
</template>

<style scoped>
.common-options {
	@apply flex items-center text-sm underline hover:opacity-40;
}
</style>
