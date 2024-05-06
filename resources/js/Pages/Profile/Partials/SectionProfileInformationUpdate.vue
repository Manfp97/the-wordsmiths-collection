<script setup>
import FormProfileInformationUpdate from "@/Forms/FormProfileInformationUpdate.vue";
import { trans } from "laravel-vue-i18n";
</script>

<template>
	<section>
		<header>
			<h2 class="pb-3 font-means-web text-2xl font-bold">
				{{ trans("page.profile.profile_update.title") }}
			</h2>

			<p class="mt-1 text-sm text-skin-muted">
				{{ trans("page.profile.profile_update.message") }}
			</p>
		</header>

		<FormProfileInformationUpdate class="mt-6 space-y-6" />
	</section>
</template>
