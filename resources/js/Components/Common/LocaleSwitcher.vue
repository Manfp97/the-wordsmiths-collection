<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import { trans, getActiveLanguage, loadLanguageAsync } from "laravel-vue-i18n";

const language = ref(getActiveLanguage());

const changeLanguage = (newLanguage) => {
	loadLanguageAsync(newLanguage).then(() => {
		router.patch(`/locale/${newLanguage}`);
		language.value = newLanguage;
	});
};
</script>

<template>
	<p class="flex w-full items-center justify-center space-x-1.5">
		<span
			:class="{ 'cursor-pointer underline': language !== 'en' }"
			@click="changeLanguage('en')"
		>
			{{ trans("language.english") }}
		</span>
		<span>|</span>
		<span
			:class="{ 'cursor-pointer underline': language !== 'es' }"
			@click="changeLanguage('es')"
		>
			{{ trans("language.spanish") }}
		</span>
	</p>
</template>
