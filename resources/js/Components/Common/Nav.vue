<script setup>
import { ref, onMounted, computed } from "vue";
import { initFlowbite } from "flowbite";
import { usePage } from "@inertiajs/vue3";
import Logo from "@/Components/Common/Logo.vue";
import ModalAddContent from "@/Components/Modals/ModalAddContent.vue";
import IconSearch from "@icons/search.svg?component";
import IconMenu from "@icons/menu.svg?component";
import IconUserCircle from "@icons/user-circle.svg?component";

onMounted(() => {
	initFlowbite();
});

defineProps({
	navClass: {
		type: String,
		required: false,
		default: null,
	},
	shouldWrapInContainer: {
		type: Boolean,
		required: false,
		default: false,
	},
});

const $searchInput = ref(null);
const addingContent = ref(false);

const user = computed(() => usePage().props.auth.user);
const isAdmin = user.value?.role_id === 1;
</script>

<template>
	<nav
		class="fixed top-0 z-40 w-full bg-skin-tertiary text-skin-white lg:px-12"
		:class="{ [navClass]: !!navClass }"
	>
		<div
			class="flex flex-wrap items-center justify-between p-4 md:justify-normal"
			:class="{ container: shouldWrapInContainer }"
		>
			<Logo
				class="mr-8"
				size="sm"
				:should-invert-icon-color="true"
			/>

			<div
				class="flex items-center space-x-1 rtl:space-x-reverse md:order-2 md:flex-row-reverse md:space-x-0"
			>
				<!-- User icon -->
				<button
					v-if="user"
					id="user-menu-button"
					type="button"
					class="me-1 flex rounded-full text-sm focus:ring-2 focus:ring-skin-border md:me-0"
					aria-expanded="false"
					data-dropdown-toggle="user-dropdown"
					data-dropdown-placement="bottom"
				>
					<span class="sr-only">Open user menu</span>
					<IconUserCircle
						class="h-10 w-10 rounded-full"
						fill="none"
					/>
				</button>

				<!-- Unregistered options -->
				<div
					v-else
					class="flex h-9 space-x-2"
				>
					<Link
						href="/subscribe"
						class="flex min-w-[2rem] items-center justify-center rounded-lg bg-skin-secondary px-3 text-sm font-bold uppercase text-skin-text hover:bg-skin-secondary-offset"
					>
						Subscribe
					</Link>
					<Link
						href="/login"
						class="flex min-w-[2rem] items-center justify-center rounded-lg border-2 border-skin-white px-3 text-sm font-bold uppercase text-skin-white hover:border-skin-border"
					>
						Log in
					</Link>
				</div>

				<!-- Search icon -->
				<button
					type="button"
					data-collapse-toggle="navbar-user"
					aria-controls="navbar-user"
					aria-expanded="false"
					class="me-1 rounded-lg p-2.5 text-sm hover:bg-skin-secondary-offset hover:text-skin-muted focus:text-skin-muted focus:outline-none focus:ring-2 focus:ring-skin-secondary md:hidden"
					@click="$searchInput ? $searchInput.focus() : null"
				>
					<IconSearch
						class="h-5 w-5"
						aria-hidden="true"
						fill="none"
					/>
					<span class="sr-only">Search</span>
				</button>

				<!-- Search input -->
				<div class="relative hidden md:!mr-4 md:block">
					<div
						class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3"
					>
						<IconSearch
							class="h-4 w-4 text-skin-muted"
							aria-hidden="true"
							fill="none"
						/>
						<span class="sr-only">Search icon</span>
					</div>
					<input
						id="search-navbar"
						type="text"
						class="block w-full rounded-lg border border-skin-border p-2 ps-10 text-sm text-skin-text focus:border-skin-secondary focus:ring-skin-secondary"
						autocomplete="off"
						placeholder="Search..."
					/>
				</div>

				<!-- User dropdown menu -->
				<div
					v-if="user"
					id="user-dropdown"
					class="z-40 my-4 hidden list-none divide-y divide-skin-border rounded-lg bg-skin-primary text-base shadow"
				>
					<div class="px-4 py-3">
						<span class="block text-sm font-semibold text-skin-text">
							{{ user.username }}
						</span>
						<span class="block truncate text-sm text-skin-muted">
							{{ user.email }}
						</span>
					</div>
					<ul
						class="py-2"
						aria-labelledby="user-menu-button"
					>
						<li>
							<Link
								href="/profile"
								class="block px-4 py-2 text-sm text-skin-text hover:bg-skin-secondary-offset"
							>
								Profile
							</Link>
						</li>
						<li>
							<button
								v-if="isAdmin"
								class="block w-full px-4 py-2 text-left text-sm text-skin-text hover:bg-skin-secondary-offset"
								type="button"
								@click="addingContent = true"
							>
								Add content
							</button>
						</li>
						<li>
							<Link
								href="/logout"
								method="post"
								as="button"
								class="block w-full px-4 py-2 text-left text-sm text-skin-danger hover:bg-skin-secondary-offset"
							>
								Log out
							</Link>
						</li>
					</ul>
				</div>

				<!-- Hamburger menu -->
				<button
					data-collapse-toggle="navbar-user"
					type="button"
					class="inline-flex h-10 w-10 flex-grow items-center justify-center rounded-lg p-2 text-sm hover:bg-skin-secondary-offset hover:text-skin-muted focus:text-skin-muted focus:outline-none focus:ring-2 focus:ring-skin-secondary md:hidden"
					aria-controls="navbar-user"
					aria-expanded="false"
				>
					<span class="sr-only">Open main menu</span>
					<IconMenu
						class="h-5 w-5"
						aria-hidden="true"
						fill="none"
					/>
				</button>
			</div>

			<div
				id="navbar-user"
				class="z-50 hidden w-full flex-grow items-center justify-between md:z-0 md:order-1 md:flex md:w-auto"
			>
				<div class="relative mt-3 md:hidden">
					<div
						class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3"
					>
						<IconSearch
							class="h-4 w-4 text-skin-muted"
							aria-hidden="true"
							fill="none"
						/>
					</div>
					<input
						id="search-navbar-hamburger"
						ref="$searchInput"
						type="text"
						class="block w-full rounded-lg border border-skin-border p-2 ps-10 text-sm text-skin-text focus:border-skin-secondary focus:ring-skin-secondary"
						autocomplete="off"
						placeholder="Search..."
					/>
				</div>
				<ul
					class="mt-4 flex flex-col rounded-lg border border-skin-border p-4 font-medium rtl:space-x-reverse md:mt-0 md:flex-row md:space-x-8 md:border-0 md:p-0 max-md:bg-skin-primary max-md:text-skin-text"
				>
					<li>
						<Link
							href="#"
							class="active-link block rounded px-3 py-2 hover:bg-skin-secondary-offset md:p-0 md:hover:bg-skin-transparent md:hover:underline"
							aria-current="page"
						>
							Home
						</Link>
					</li>
					<li>
						<Link
							href="#"
							class="block rounded px-3 py-2 hover:bg-skin-secondary-offset md:p-0 md:hover:bg-skin-transparent md:hover:underline"
						>
							Categories
						</Link>
					</li>
					<li>
						<Link
							href="#"
							class="block rounded px-3 py-2 hover:bg-skin-secondary-offset md:p-0 md:hover:bg-skin-transparent md:hover:underline"
						>
							Authors
						</Link>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<ModalAddContent
		v-if="isAdmin"
		:show="addingContent"
		@close="addingContent = false"
	/>
</template>

<style scoped>
.active-link {
	@apply bg-skin-secondary md:bg-skin-transparent md:underline md:decoration-skin-secondary md:decoration-4;
}
</style>
