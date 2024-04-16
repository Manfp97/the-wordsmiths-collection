<script setup>
import { computed } from "vue";
import { getFormattedDate } from "@/Helpers/stringHelper.js";
import IconTrash from "@icons/trash.svg?component";
import IconEdit from "@icons/edit.svg?component";

const emit = defineEmits(["edit", "delete"]);

const props = defineProps({
	user: {
		type: Object,
		required: true,
	},
});

const status = computed(() => props.user.subscription?.status);

const formattedStartDate = getFormattedDate(
	props.user.subscription?.start_date
);
const formattedEndDate = getFormattedDate(props.user.subscription?.end_date);
</script>

<template>
	<tr>
		<td class="td-common">
			{{ user.id }}
		</td>

		<td class="td-common">
			<div class="text-sm">{{ user.username }}</div>
			<div class="text-sm text-skin-muted">{{ user.email }}</div>
		</td>

		<td class="td-common text-sm">
			{{ user.subscription?.plan.name ?? "-" }}
		</td>

		<td class="td-common text-sm">
			{{ formattedStartDate }}
		</td>

		<td class="td-common text-sm">
			{{ formattedEndDate }}
		</td>

		<td class="td-common">
			<span
				class="inline-flex rounded-full px-2 text-xs font-semibold capitalize leading-5"
				:class="{
					'bg-skin-success-light': status === 'active',
					'bg-skin-danger-light': status === 'canceled' || status === 'expired',
				}"
			>
				{{ status }}
			</span>
		</td>

		<td class="td-common text-sm capitalize text-skin-muted">
			{{ user.role.name }}
		</td>

		<td class="td-common space-y-1 text-right text-sm font-medium">
			<button
				class="flex text-skin-danger hover:text-skin-text"
				@click="emit('delete')"
			>
				<IconTrash class="mr-1 w-5" />
				Delete
			</button>

			<button
				class="flex text-skin-link hover:text-skin-text"
				@click="emit('edit')"
			>
				<IconEdit class="mr-1 w-5" />
				Edit
			</button>
		</td>
	</tr>
</template>

<style scoped>
.td-common {
	@apply whitespace-nowrap px-6 py-4;
}
</style>
