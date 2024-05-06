<script setup>
import { computed } from "vue";
import { getActiveLanguage, loadLanguageAsync } from "laravel-vue-i18n";

const activeLanguage = computed(() => getActiveLanguage());

const changeLanguage = (language) => {
	if (activeLanguage.value !== language) {
		loadLanguageAsync(language);
	}
};
</script>

<template>
	<p class="flex w-full items-center justify-center space-x-1.5">
		<span
			:class="{ 'cursor-pointer underline': activeLanguage !== 'es' }"
			@click="changeLanguage('es')"
		>
			Español
		</span>
		<span>|</span>
		<span
			:class="{ 'cursor-pointer underline': activeLanguage !== 'en' }"
			@click="changeLanguage('en')"
		>
			English
		</span>
	</p>
	<!-- 	
	<div
		class="flex items-center space-x-1 rtl:space-x-reverse md:order-2 md:space-x-0"
	>
		<button
			type="button"
			data-dropdown-toggle="language-dropdown-menu"
			class="inline-flex cursor-pointer items-center justify-center rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white"
		>
			English (US)
		</button>
		<div
			id="language-dropdown-menu"
			class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded-lg bg-white text-base shadow dark:bg-gray-700"
		>
			<ul
				class="py-2 font-medium"
				role="none"
			>
				<li>
					<a
						href="#"
						class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
						role="menuitem"
					>
						<div class="inline-flex items-center">English (US)</div>
					</a>
				</li>
				<li>
					<a
						href="#"
						class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
						role="menuitem"
					>
						<div class="inline-flex items-center">Deutsch</div>
					</a>
				</li>
				<li>
					<a
						href="#"
						class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
						role="menuitem"
					>
						<div class="inline-flex items-center">Italiano</div>
					</a>
				</li>
				<li>
					<a
						href="#"
						class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
						role="menuitem"
					>
						<div class="inline-flex items-center">中文 (繁體)</div>
					</a>
				</li>
			</ul>
		</div>
		<button
			data-collapse-toggle="navbar-language"
			type="button"
			class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 md:hidden"
			aria-controls="navbar-language"
			aria-expanded="false"
		>
			<span class="sr-only">Open main menu</span>
			<svg
				class="h-5 w-5"
				aria-hidden="true"
				xmlns="http://www.w3.org/2000/svg"
				fill="none"
				viewBox="0 0 17 14"
			>
				<path
					stroke="currentColor"
					stroke-linecap="round"
					stroke-linejoin="round"
					stroke-width="2"
					d="M1 1h15M1 7h15M1 13h15"
				/>
			</svg>
		</button>
	</div> -->
</template>
