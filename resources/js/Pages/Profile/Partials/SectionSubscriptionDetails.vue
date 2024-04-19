<script setup>
import { ref, computed } from "vue";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";

const props = defineProps({
	subscription: {
		type: Object,
		required: true,
	},
	otherSubscriptionPlan: {
		type: Object,
		required: true,
	},
});

const isCancelSubscriptionModalOpen = ref(false);
const isChangePlanModalOpen = ref(false);

const isSubscriptionCanceled = computed(
	() => props.subscription.status === "canceled"
);
const isSubscriptionActive = computed(
	() => props.subscription.status === "active"
);

const startDate = new Date(props.subscription.start_date);
const formattedStartDate = startDate.toLocaleDateString();

const endDate = new Date(props.subscription.end_date);
const formattedEndDate = endDate.toLocaleDateString();
</script>

<template>
	<section class="space-y-6">
		<header>
			<h2 class="font-means-web text-2xl font-bold">Subscription details</h2>
		</header>

		<div>
			<h3 class="text-lg">{{ subscription.plan.name }} subscription plan</h3>
			<p>
				<span class="font-bold">Status</span>:
				<span class="capitalize">{{ subscription.status }}</span>
			</p>
			<p>
				<span class="font-bold">Active since</span>: {{ formattedStartDate }}
			</p>
			<p v-if="isSubscriptionCanceled">
				<span class="font-bold">Active until</span>: {{ formattedEndDate }}
			</p>
			<p v-if="isSubscriptionActive">
				<span class="font-bold">Next payment date</span>: {{ formattedEndDate }}
			</p>
		</div>

		<div class="flex w-fit space-x-3">
			<button
				v-if="isSubscriptionActive"
				class="button"
				@click="isChangePlanModalOpen = true"
			>
				Change subscription plan
			</button>

			<Link
				v-if="isSubscriptionCanceled"
				href="/subscription/reactivate"
				method="post"
				as="button"
				class="button !bg-skin-success text-skin-white"
				preserve-scroll
			>
				Reactivate subscription
			</Link>

			<button
				v-if="isSubscriptionActive"
				class="button !bg-skin-danger text-skin-white"
				@click="isCancelSubscriptionModalOpen = true"
			>
				Cancel subscription
			</button>
		</div>

		<ModalContainer
			v-if="isSubscriptionActive"
			modal-id="modal-cancel-subscription"
			modal-title="Cancel subscription"
			:show="isCancelSubscriptionModalOpen"
			@close="isCancelSubscriptionModalOpen = false"
		>
			<div class="space-y-2">
				<p>
					Your subscription will be canceled on {{ formattedEndDate }}. Until
					then, you can keep enjoying The Wordsmith's Collection.
				</p>
				<p>
					You can reactivate your The Wordsmith's Collection account at any time
					to keep reading.
				</p>
				<p>Do you want to cancel your subscription?</p>
			</div>

			<div class="mt-6 flex justify-end space-x-4">
				<button
					class="button !bg-skin-muted text-skin-white"
					@click="isCancelSubscriptionModalOpen = false"
				>
					No
				</button>

				<Link
					href="/subscription/cancel"
					method="post"
					as="button"
					class="button !bg-skin-danger text-skin-white"
					preserve-scroll
					@click="isCancelSubscriptionModalOpen = false"
				>
					Yes
				</Link>
			</div>
		</ModalContainer>

		<ModalContainer
			v-if="isSubscriptionActive"
			modal-id="modal-cancel-subscription"
			modal-title="Change subscription plan"
			:show="isChangePlanModalOpen"
			@close="isChangePlanModalOpen = false"
		>
			<div>
				<div class="rounded-t-md border-b border-skin-border bg-skin-white p-3">
					<p class="mb-2 text-sm font-bold uppercase">Current plan</p>
					<p>
						{{ subscription.plan.name }}: {{ subscription.plan.price }}
						{{ subscription.plan.currency }}/month
					</p>
				</div>

				<div class="rounded-b-md bg-skin-white p-3">
					<p class="mb-2 text-sm font-bold uppercase">New plan</p>
					<p>
						{{ otherSubscriptionPlan.name }}:
						{{ otherSubscriptionPlan.price }}
						{{ otherSubscriptionPlan.currency }}/month
					</p>
				</div>

				<div class="mt-4 space-y-2">
					<p>
						Your new plan starts now. You'll pay
						{{ otherSubscriptionPlan.price }}
						{{ otherSubscriptionPlan.currency }} starting
						{{ formattedEndDate }}.
					</p>

					<p>
						You agree that your
						<strong>
							The Wordsmith's Collection membership will continue and that we
							will change the updated monthly fee until you cancel. You may
							cancel at any time to avoid future changes. To cancel, close this
							modal and click on "Cancel subscription" on this page.
						</strong>
					</p>
				</div>
			</div>

			<div class="mt-6 flex justify-end space-x-4">
				<button
					class="button !bg-skin-muted text-skin-white"
					@click="isChangePlanModalOpen = false"
				>
					Cancel
				</button>

				<Link
					:href="`/subscription/update/${otherSubscriptionPlan.id}`"
					method="patch"
					as="button"
					class="button"
					preserve-scroll
					@click="isChangePlanModalOpen = false"
				>
					Confirm change
				</Link>
			</div>
		</ModalContainer>
	</section>
</template>
