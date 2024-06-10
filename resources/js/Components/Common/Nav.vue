<script setup>
import { ref, onMounted, computed } from "vue";
import { initFlowbite } from "flowbite";
import { usePage, router } from "@inertiajs/vue3";
import { trans } from "laravel-vue-i18n";
import Logo from "@/Components/Common/Logo.vue";
import InputWithIcon from "@/Components/Forms/InputWithIcon.vue";
import ModalAddContent from "@/Components/Modals/ModalAddContent.vue";
import IconSearch from "@icons/search.svg?component";
import IconMenu from "@icons/menu.svg?component";
import IconUserCircle from "@icons/user-circle.svg?component";

onMounted(() => {
	initFlowbite();
});

const props = defineProps({
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
	query: {
		type: String,
		required: false,
		default: null,
	},
});

const $hamburgerButton = ref(null);

const search = ref(props.query);
const performSearch = () => {
	router.get(
		"/search",
		{ ...(search.value !== "" ? { query: search.value } : null) },
		{
			preserveState: true,
			replace: true, // avoids adding new entries into the browser history for each search we make
		}
	);
};

const hideHamburgerMenu = () => {
	if ($hamburgerButton.value) {
		$hamburgerButton.value.click();
	}
};

const performSearchFromHamburgerMenu = () => {
	performSearch();
	hideHamburgerMenu();
};

const isAddingContent = ref(false);

const user = computed(() => usePage().props.auth.user);
const isAdmin = user.value?.role_id === 1;
</script>

<template>
	<nav
		class="fixed top-0 z-40 w-full bg-skin-tertiary text-skin-white xl:px-12"
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
					<span class="sr-only">{{
						trans("component.nav.open_user_menu")
					}}</span>
					<IconUserCircle
						class="h-10 w-10 rounded-full"
						fill="none"
					/>
				</button>

				<!-- Unregistered options -->
				<div
					v-else
					class="hidden h-9 space-x-2 lg:flex"
				>
					<Link
						href="/subscribe"
						class="flex min-w-[2rem] items-center justify-center rounded-lg bg-skin-secondary px-3 text-sm font-bold uppercase text-skin-text hover:bg-skin-secondary-offset"
					>
						{{ trans("common.action.subscribe") }}
					</Link>
					<Link
						href="/login"
						class="flex min-w-[2rem] items-center justify-center rounded-lg border-2 border-skin-white px-3 text-sm font-bold uppercase text-skin-white hover:border-skin-border"
					>
						{{ trans("common.action.log_in") }}
					</Link>
				</div>

				<!-- Search icon -->
				<button
					type="button"
					data-collapse-toggle="navbar-user"
					aria-controls="navbar-user"
					aria-expanded="false"
					class="me-1 block rounded-lg p-2.5 text-sm hover:bg-skin-secondary-offset hover:text-skin-muted focus:text-skin-muted focus:outline-none focus:ring-2 focus:ring-skin-secondary lg:hidden"
					@click="$searchInput ? $searchInput.focus() : null"
				>
					<IconSearch
						class="h-5 w-5"
						aria-hidden="true"
						fill="none"
					/>
					<span class="sr-only">{{ trans("common.action.search") }}</span>
				</button>

				<!-- Search input -->
				<InputWithIcon
					v-model:value="search"
					input-type="text"
					input-autocomplete="off"
					:input-placeholder="`${trans('common.action.search')}...`"
					:icon-aria-label="trans('common.action.search')"
					class="hidden md:!mr-4 lg:block"
					@enter="performSearch"
				>
					<IconSearch
						class="h-4 w-4 text-skin-muted"
						aria-hidden="true"
						fill="none"
					/>
				</InputWithIcon>

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
								{{ trans("common.noun.profile") }}
							</Link>
						</li>
						<li v-if="isAdmin">
							<button
								class="block w-full px-4 py-2 text-left text-sm text-skin-text hover:bg-skin-secondary-offset"
								type="button"
								@click="isAddingContent = true"
							>
								{{ trans("component.nav.add_content") }}
							</button>
						</li>
						<li v-if="isAdmin">
							<Link
								href="/users"
								as="button"
								class="block w-full px-4 py-2 text-left text-sm text-skin-text hover:bg-skin-secondary-offset"
							>
								{{ trans("users") }}
							</Link>
						</li>
						<li>
							<Link
								href="/logout"
								method="post"
								as="button"
								class="block w-full px-4 py-2 text-left text-sm text-skin-danger hover:bg-skin-secondary-offset"
							>
								{{ trans("common.action.log_out") }}
							</Link>
						</li>
					</ul>
				</div>

				<!-- Hamburger menu -->
				<button
					ref="$hamburgerButton"
					data-collapse-toggle="navbar-user"
					type="button"
					class="inline-flex h-10 w-10 flex-grow items-center justify-center rounded-lg p-2 text-sm hover:bg-skin-secondary-offset hover:text-skin-muted focus:text-skin-muted focus:outline-none focus:ring-2 focus:ring-skin-secondary lg:hidden"
					aria-controls="navbar-user"
					aria-expanded="false"
				>
					<span class="sr-only">{{
						trans("component.nav.open_main_menu")
					}}</span>
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
				<InputWithIcon
					v-model:value="search"
					input-type="text"
					input-autocomplete="off"
					:input-placeholder="`${trans('common.action.search')}...`"
					:icon-aria-label="trans('common.action.search')"
					class="mt-3 md:hidden"
					@enter="performSearchFromHamburgerMenu"
				>
					<IconSearch
						class="h-4 w-4 text-skin-muted"
						aria-hidden="true"
						fill="none"
					/>
				</InputWithIcon>

				<ul
					class="mt-4 flex flex-col rounded-lg border border-skin-border p-4 font-medium rtl:space-x-reverse md:mt-0 md:flex-row md:space-x-8 md:border-0 md:p-0 max-md:bg-skin-primary max-md:text-skin-text"
				>
					<li>
						<Link
							href="/"
							class="block rounded px-3 py-2 hover:bg-skin-secondary-offset md:p-0 md:hover:bg-skin-transparent md:hover:underline"
							:class="{ 'active-link': usePage().component === 'Index' }"
						>
							{{ trans("genres") }}
						</Link>
					</li>
					<li>
						<Link
							href="/books"
							class="block rounded px-3 py-2 hover:bg-skin-secondary-offset md:p-0 md:hover:bg-skin-transparent md:hover:underline"
							:class="{ 'active-link': usePage().component === 'Book/Index' }"
						>
							{{ trans("books") }}
						</Link>
					</li>
					<li>
						<Link
							href="/authors"
							class="block rounded px-3 py-2 hover:bg-skin-secondary-offset md:p-0 md:hover:bg-skin-transparent md:hover:underline"
							:class="{ 'active-link': usePage().component === 'Author/Index' }"
						>
							{{ trans("authors") }}
						</Link>
					</li>
					<li
						v-if="!user"
						class="mt-2"
					>
						<div
							class="grid grid-cols-2 gap-x-3 text-center font-bold sm:hidden"
						>
							<Link
								href="/subscribe"
								class="block rounded border-2 border-skin-secondary bg-skin-secondary bg-opacity-60 px-3 py-2 hover:bg-opacity-100 md:p-0 md:hover:underline"
							>
								{{ trans("common.action.subscribe") }}
							</Link>
							<Link
								href="/login"
								class="block rounded border-2 border-skin-tertiary bg-skin-tertiary bg-opacity-60 px-3 py-2 text-skin-white hover:bg-opacity-100 md:p-0 md:hover:underline"
							>
								{{ trans("common.action.log_in") }}
							</Link>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<ModalAddContent
		v-if="isAdmin"
		:show="isAddingContent"
		@close="isAddingContent = false"
	/>
</template>

<style scoped>
.active-link {
	@apply bg-skin-secondary underline-offset-4 md:bg-skin-transparent md:underline md:decoration-skin-secondary md:decoration-4;
}
</style>
