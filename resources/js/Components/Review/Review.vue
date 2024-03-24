<script setup>
import { ref } from "vue";
import Rating from "@/Components/Common/Rating.vue";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FormReview from "@/Forms/FormReview.vue";
import IconUserCircle from "@icons/user-circle.svg?component";
import IconTrash from "@icons/trash.svg?component";
import IconEdit from "@icons/edit.svg?component";

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

const isDeleting = ref(false);
const isEditing = ref(false);

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

		<div
			v-if="review.canEdit || review.canDelete"
			class="flex space-x-4"
		>
			<button
				v-if="review.canDelete"
				class="common-options text-skin-danger"
				@click="isDeleting = true"
			>
				<IconTrash class="mr-1 w-4" />
				Delete
			</button>

			<button
				v-if="review.canEdit"
				class="common-options text-skin-link"
				@click="isEditing = true"
			>
				<IconEdit class="mr-1 w-4" />
				Edit
			</button>
		</div>

		<ModalContainer
			v-if="review.canDelete"
			:modal-id="`modal-delete-review-${review.id}`"
			modal-title="Delete review"
			:show="isDeleting"
			@close="isDeleting = false"
		>
			<div class="space-y-2">
				<p>
					Are you sure you want to delete this review? This action cannot be
					undone.
				</p>
			</div>

			<div class="mt-6 flex justify-end space-x-4">
				<button
					class="button !bg-skin-text-muted text-skin-white"
					@click="isDeleting = false"
				>
					No
				</button>

				<Link
					:href="`/review/${review.id}`"
					method="delete"
					as="button"
					class="button !bg-skin-danger text-skin-white"
					preserve-scroll
					@click="isDeleting = false"
				>
					Yes
				</Link>
			</div>
		</ModalContainer>

		<ModalContainer
			v-if="review.canEdit"
			modal-id="modal-edit-review"
			modal-title="Edit review"
			:show="isEditing"
			@close="isEditing = false"
		>
			<FormReview
				:book-id="bookId"
				:review="review"
				http-method="put"
			/>
		</ModalContainer>
	</article>
</template>

<style scoped>
.common-options {
	@apply flex items-center text-sm underline hover:opacity-40;
}
</style>
