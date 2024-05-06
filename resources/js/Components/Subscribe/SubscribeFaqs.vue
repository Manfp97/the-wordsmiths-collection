<script setup>
import { ref } from "vue";
import { trans } from "laravel-vue-i18n";

defineProps({
	faqs: {
		type: Array,
		required: true,
	},
});

const selectedFaqId = ref(null);
</script>

<template>
	<section class="py-12 text-center sm:py-20">
		<h2 class="section-title mb-6 xl:mb-7">{{ trans("faq.title") }}</h2>

		<ul class="accordion mx-auto w-full text-left">
			<li
				v-for="(faq, index) in faqs"
				:key="index"
				class="w-full list-none p-1"
			>
				<input
					:id="faq.id"
					type="radio"
					class="hidden"
					name="accordion"
				/>
				<label
					class="mb-0.5 flex cursor-pointer content-center bg-skin-secondary p-5 text-lg transition-colors hover:bg-skin-secondary-offset sm:p-6 sm:text-xl md:text-2xl"
					:for="faq.id"
					@click="
						selectedFaqId == faq.id
							? (selectedFaqId = null)
							: (selectedFaqId = faq.id)
					"
				>
					<div class="flex w-full items-center justify-between">
						<span class="mr-1.5 font-semibold">{{ faq.title }}</span>
						<span
							class="close shrink-0 select-none overflow-hidden align-middle font-poppins text-[3.5rem] font-thin transition-transform duration-500"
							:class="{
								'rotate-[135deg]': selectedFaqId == faq.id,
								'transform-none': selectedFaqId != faq.id,
							}"
							aria-hidden="true"
						>
							+
						</span>
					</div>
				</label>
				<!-- eslint-disable vue/no-v-html -->
				<div
					class="text-md space-y-5 overflow-hidden bg-skin-secondary px-5 transition-all duration-500 sm:text-xl"
					:class="{
						'max-h-[37.5rem] py-7': selectedFaqId == faq.id,
						'max-h-0': selectedFaqId != faq.id,
					}"
					v-html="faq.body"
				/>
				<!--eslint-enable-->
			</li>
		</ul>
	</section>
</template>
