<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AppHead from "@/Components/Common/AppHead.vue";
import FloatingLabel from "@/Components/Common/FloatingLabel.vue";
import Logo from "@/Components/Common/Logo.vue";
import Footer from "@/Components/Common/Footer.vue";
</script>

<template>
	<AppHead
		title="Log In"
		description="Log in to your The Wordsmith's Collection account to access a vast library of the greatest works of literature."
	/>

	<div class="flex min-h-screen flex-col">
		<div
			class="bg-skin-secondary-offset flex flex-col min-h-full flex-1 items-center justify-center "
		>
			<Logo class="mt-16 2xl:mt-10 mx-4" size="md" />

			<section
				class="mt-10 mb-24 mx-4 sm:w-full max-w-lg rounded-lg border bg-skin-primary p-6 shadow sm:p-8"
			>
				<form
					class="space-y-6"
					action="#"
				>
					<h5 class="font-means-web text-center text-3xl mb-8 sm:mb-12">Log in to your account</h5>

					<FloatingLabel
						:id="'email'"
						label-text="Your email or username"
						:type="'email'"
						:autocomplete="'email'"
					/>
					<FloatingLabel
						:id="'password'"
						label-text="Your password"
						:type="'password'"
						:autocomplete="'password'"
					/>

					<div class="flex items-start">
						<div class="flex items-start">
							<div class="flex h-5 items-center">
								<input
									id="remember"
									type="checkbox"
									value=""
									class="focus:ring-3 h-4 w-4 cursor-pointer rounded border border-skin-border focus:ring-skin-secondary"
									required
								/>
							</div>
							<label
								for="remember"
								class="ms-2 text-sm font-medium"
							>
								Remember me
							</label>
						</div>
						<a
							href="#"
							class="text-skin-link ms-auto text-sm hover:underline hidden"
						>
							Forgot password?
						</a>
					</div>
					<button
						type="submit"
						class="hover:!bg-skin-secondary-offset w-full rounded-lg !bg-skin-secondary px-5 py-2.5 text-center text-sm font-medium focus:outline-none focus:ring-4 focus:ring-skin-border"
					>
						Log in to your account
					</button>
					<div class="text-skin-text-muted text-center text-sm font-medium">
						Not registered?
						<Link
							href="/register"
							class="text-skin-link hover:underline"
						>
							Create account
						</Link>
					</div>
				</form>
			</section>
		</div>

		<Footer />
	</div>
</template>
