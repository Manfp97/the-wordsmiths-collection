<script setup>
import { ref, onMounted } from "vue";
import { initFlowbite } from "flowbite";
import { Link } from "@inertiajs/inertia-vue3";

// initialize components based on data attribute selectors
onMounted(() => {
	initFlowbite();
});

defineProps({
	shouldInvertIconColor: {
		type: Boolean,
		default: false,
	},
});

const searchInputField = ref(null);

const onSearchClick = () => {
	if (searchInputField.value) {
		searchInputField.value.focus();
	}
};
</script>

<template>
	<nav class="border-skin-secondary-offset">
		<div
			class="container flex flex-wrap items-center justify-between p-4 md:justify-normal"
		>
			<Link
				href="/"
				class="mr-8 flex items-center space-x-3 rtl:space-x-reverse"
			>
				<img
					:src="'/icon.svg'"
					:class="{ 'grayscale invert': shouldInvertIconColor }"
					class="h-8"
					alt="The Wordsmith's Collection Logo"
				/>
				<div class="flex flex-col font-means-web">
					<p class="self-center text-lg font-semibold leading-5">
						The Wordsmith's
					</p>
					<p class="self-center text-lg font-semibold leading-3">Collection</p>
				</div>
			</Link>
			<div
				class="flex items-center space-x-1 rtl:space-x-reverse md:order-2 md:flex-row-reverse md:space-x-0"
			>
				<!-- User icon -->
				<button
					id="user-menu-button"
					type="button"
					class="me-1 flex rounded-full bg-skin-card text-sm focus:ring-4 focus:ring-skin-border md:me-0"
					aria-expanded="false"
					data-dropdown-toggle="user-dropdown"
					data-dropdown-placement="bottom"
				>
					<span class="sr-only">Open user menu</span>
					<img
						class="h-8 w-8 rounded-full"
						src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
						alt="user photo"
					/>
				</button>

				<!-- Search icon -->
				<button
					type="button"
					data-collapse-toggle="navbar-user"
					aria-controls="navbar-user"
					aria-expanded="false"
					class="me-1 rounded-lg p-2.5 text-sm hover:bg-skin-secondary-offset hover:text-skin-text-muted focus:text-skin-text-muted focus:outline-none focus:ring-2 focus:ring-skin-secondary md:hidden"
					@click="onSearchClick"
				>
					<svg
						class="h-5 w-5"
						aria-hidden="true"
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 20 20"
					>
						<path
							stroke="currentColor"
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
						/>
					</svg>
					<span class="sr-only">Search</span>
				</button>

				<!-- Search input -->
				<div class="relative hidden md:!mr-4 md:block">
					<div
						class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3"
					>
						<svg
							class="h-4 w-4 text-skin-text-muted"
							aria-hidden="true"
							xmlns="http://www.w3.org/2000/svg"
							fill="none"
							viewBox="0 0 20 20"
						>
							<path
								stroke="currentColor"
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
							/>
						</svg>
						<span class="sr-only">Search icon</span>
					</div>
					<input
						id="search-navbar"
						type="text"
						class="block w-full rounded-lg border border-skin-border bg-gray-100 p-2 ps-10 text-sm text-skin-text focus:border-skin-secondary focus:ring-skin-secondary"
						placeholder="Search..."
					/>
				</div>

				<!-- User dropdown menu -->
				<div
					id="user-dropdown"
					class="z-50 my-4 hidden list-none divide-y divide-skin-border rounded-lg bg-skin-primary text-base shadow"
				>
					<div class="px-4 py-3">
						<span class="block text-sm font-semibold text-skin-text">
							John Doe
						</span>
						<span class="block truncate text-sm text-skin-text-muted">
							example@mail.com
						</span>
					</div>
					<ul
						class="py-2"
						aria-labelledby="user-menu-button"
					>
						<li>
							<a
								href="#"
								class="block px-4 py-2 text-sm text-skin-text hover:bg-skin-secondary-offset"
							>
								Settings
							</a>
						</li>
						<li>
							<a
								href="#"
								class="block px-4 py-2 text-sm text-skin-text hover:bg-skin-secondary-offset"
							>
								Sign out
							</a>
						</li>
					</ul>
				</div>

				<!-- Hamburger menu -->
				<button
					data-collapse-toggle="navbar-user"
					type="button"
					class="inline-flex h-10 w-10 flex-grow items-center justify-center rounded-lg p-2 text-sm hover:bg-skin-secondary-offset hover:text-skin-text-muted focus:text-skin-text-muted focus:outline-none focus:ring-2 focus:ring-skin-secondary md:hidden"
					aria-controls="navbar-user"
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
			</div>

			<div
				id="navbar-user"
				class="hidden w-full flex-grow items-center justify-between md:order-1 md:flex md:w-auto"
			>
				<div class="relative mt-3 md:hidden">
					<div
						class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3"
					>
						<svg
							class="h-4 w-4 text-skin-text-muted"
							aria-hidden="true"
							xmlns="http://www.w3.org/2000/svg"
							fill="none"
							viewBox="0 0 20 20"
						>
							<path
								stroke="currentColor"
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
							/>
						</svg>
					</div>
					<input
						id="search-navbar-hamburger"
						ref="searchInputField"
						type="text"
						class="block w-full rounded-lg border border-skin-border bg-gray-100 p-2 ps-10 text-sm text-skin-text focus:border-skin-secondary focus:ring-skin-secondary"
						placeholder="Search..."
					/>
				</div>
				<ul
					class="mt-4 flex flex-col rounded-lg border border-skin-border p-4 font-medium rtl:space-x-reverse md:mt-0 md:flex-row md:space-x-8 md:border-0 md:p-0 max-md:bg-skin-primary max-md:text-skin-text"
				>
					<li>
						<Link
							href="#"
							class="active-link block rounded px-3 py-2 hover:bg-skin-secondary-offset md:p-0 md:hover:bg-transparent md:hover:underline"
							aria-current="page"
						>
							Home
						</Link>
					</li>
					<li>
						<Link
							class="block rounded px-3 py-2 hover:bg-skin-secondary-offset md:p-0 md:hover:bg-transparent md:hover:underline"
						>
							Categories
						</Link>
					</li>
					<li>
						<Link
							href="#"
							class="block rounded px-3 py-2 hover:bg-skin-secondary-offset md:p-0 md:hover:bg-transparent md:hover:underline"
						>
							Authors
						</Link>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>

<style scoped>
.active-link {
	@apply bg-skin-secondary md:bg-transparent md:underline md:decoration-skin-secondary md:decoration-4;
}
</style>
