<script setup>
import FormPasswordUpdate from "@/Forms/FormPasswordUpdate.vue";
</script>

<template>
	<section>
		<header>
			<h2 class="pb-3 font-means-web text-2xl font-bold">Update password</h2>

			<p class="mt-1 text-sm text-skin-muted">
				Ensure your account is using a long, random password to stay secure.
			</p>
		</header>

		<FormPasswordUpdate class="mt-6 space-y-6" />
	</section>
</template>
