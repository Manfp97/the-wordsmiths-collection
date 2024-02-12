<script setup>
import AppHead from "@/Components/Common/AppHead.vue";
import Logo from "@/Components/Common/Logo.vue";
import Footer from "@/Components/Common/Footer.vue";
import FormLogIn from "@/Forms/FormLogIn.vue";
</script>

<template>
	<AppHead
		title="Log In"
		description="Log in to your The Wordsmith's Collection account to access a vast library of the greatest works of literature."
	/>

	<div class="flex min-h-screen flex-col">
		<div
			class="flex min-h-full flex-1 flex-col items-center justify-center bg-skin-secondary-offset"
		>
			<Logo
				class="mx-4 mt-16 2xl:mt-10"
				size="md"
			/>

			<section
				class="mx-4 mb-24 mt-10 max-w-lg rounded-lg border bg-skin-primary p-6 shadow sm:w-full sm:p-8"
			>
				<FormLogIn />
			</section>
		</div>

		<Footer />
	</div>
</template>
