<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import { capitalized } from "@/Helpers/stringHelper.js";
import FormBook from "@/Components/Modals/Forms/FormBook.vue";
import FormAuthor from "@/Components/Modals/Forms/FormAuthor.vue";
import FormCategory from "@/Components/Modals/Forms/FormCategory.vue";

onMounted(() => {
	initFlowbite();
});
</script>

<template>
	<Teleport to="body">
		<div
			id="modal-add"
			tabindex="-1"
			aria-hidden="true"
			class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full"
		>
			<div class="relative h-full w-full max-w-2xl p-4 md:h-auto">
				<!-- Modal content -->
				<div class="relative rounded-lg bg-skin-primary p-4 shadow sm:p-5">
					<!-- Modal header -->
					<div class="mb-1 flex items-center justify-between rounded-t">
						<h3 class="text-xl font-semibold">What do you want to add?</h3>
						<button
							type="button"
							class="ml-auto text-sm text-skin-text-muted hover:text-skin-danger"
							data-modal-toggle="modal-add"
						>
							<svg
								aria-hidden="true"
								class="h-5 w-5"
								fill="currentColor"
								viewBox="0 0 20 20"
								xmlns="http://www.w3.org/2000/svg"
							>
								<path
									fill-rule="evenodd"
									d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
									clip-rule="evenodd"
								/>
							</svg>
							<span class="sr-only">Close modal</span>
						</button>
					</div>

					<!-- Modal tabs -->
					<div class="mb-4 border-b border-skin-border">
						<ul
							id="modal-add-tabs"
							class="-mb-px flex flex-wrap text-center text-sm font-medium"
							data-tabs-toggle="#modal-add-tab-content"
							role="tablist"
						>
							<template
								v-for="tabName in ['book', 'author', 'category']"
								:key="tabName"
							>
								<li
									class="me-2"
									role="presentation"
								>
									<button
										:id="`modal-add-tab-${tabName}`"
										class="inline-block rounded-t-lg border-b-2 p-4"
										:data-tabs-target="`#modal-add-tab-${tabName}-content`"
										type="button"
										role="tab"
										:aria-controls="`modal-add-tab-${tabName}-content`"
										aria-selected="false"
									>
										{{ capitalized(tabName) }}
									</button>
								</li>
							</template>
						</ul>
					</div>

					<div id="modal-add-tab-content">
						<FormBook
							id="modal-add-tab-book-content"
							class="hidden py-2"
							role="tabpanel"
							aria-labelledby="modal-add-tab-book"
						/>
						<FormAuthor
							id="modal-add-tab-author-content"
							class="hidden py-2"
							role="tabpanel"
							aria-labelledby="modal-add-tab-author"
						/>
						<FormCategory
							id="modal-add-tab-category-content"
							class="hidden py-2"
							role="tabpanel"
							aria-labelledby="modal-add-tab-category"
						/>
					</div>
				</div>
			</div>
		</div>
	</Teleport>
</template>
