<script setup>
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
			class="flex min-h-full flex-1 flex-col items-center justify-center bg-skin-secondary-offset"
		>
			<Logo
				class="mx-4 mt-16 2xl:mt-10"
				size="md"
			/>

			<section
				class="mx-4 mb-24 mt-10 max-w-lg rounded-lg border bg-skin-primary p-6 shadow sm:w-full sm:p-8"
			>
				<form
					class="space-y-6"
					action="#"
				>
					<h5
						class="mb-8 text-center font-means-web text-3xl font-bold sm:mb-12"
					>
						Log in to your account
					</h5>

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
							class="ms-auto hidden text-sm text-skin-link hover:underline"
						>
							Forgot password?
						</a>
					</div>
					<button
						type="submit"
						class="w-full rounded-lg !bg-skin-secondary px-5 py-2.5 text-center text-sm font-bold hover:!bg-skin-secondary-offset focus:outline-none focus:ring-4 focus:ring-skin-border"
					>
						Log in to your account
					</button>
					<div class="text-center text-sm font-medium text-skin-text-muted">
						Not registered?
						<Link
							href="/register/account"
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
