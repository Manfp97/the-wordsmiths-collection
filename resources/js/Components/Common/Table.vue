<script setup>
defineProps({
	columns: {
		type: Array,
		required: true,
	},
});
</script>

<template>
	<div class="flex flex-col">
		<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
				<div
					class="overflow-hidden border-b border-skin-border shadow sm:rounded-lg"
				>
					<table class="min-w-full divide-y divide-skin-border">
						<thead class="bg-skin-primary-offset">
							<tr>
								<th
									v-for="(column, index) in columns"
									:key="index"
									scope="col"
									class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-skin-muted"
								>
									{{ column }}
								</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-skin-border bg-skin-white">
							<slot />
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>
