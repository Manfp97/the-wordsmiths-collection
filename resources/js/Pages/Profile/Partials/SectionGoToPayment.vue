<script setup>
import { trans } from "laravel-vue-i18n";
</script>

<template>
	<section>
		<header>
			<h2 class="pb-3 font-means-web text-2xl font-bold">
				{{ trans("page.profile.go_to_payment.title") }}
			</h2>

			<p class="mt-1 text-sm text-skin-muted">
				{{ trans("page.profile.go_to_payment.message") }}
			</p>
		</header>

		<div class="mt-6">
			<Link
				href="/subscribe"
				class="button"
			>
				{{ trans("page.profile.go_to_payment.button") }}
			</Link>
		</div>
	</section>
</template>
