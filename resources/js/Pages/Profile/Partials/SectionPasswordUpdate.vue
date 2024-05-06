<script setup>
import { trans } from "laravel-vue-i18n";
import FormPasswordUpdate from "@/Forms/FormPasswordUpdate.vue";
</script>

<template>
	<section>
		<header>
			<h2 class="pb-3 font-means-web text-2xl font-bold">
				{{ trans("page.profile.password_update.title") }}
			</h2>

			<p class="mt-1 text-sm text-skin-muted">
				{{ trans("page.profile.password_update.message") }}
			</p>
		</header>

		<FormPasswordUpdate class="mt-6 space-y-6" />
	</section>
</template>
