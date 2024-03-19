<script setup>
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";
import ModalContainer from "@/Components/Modals/ModalContainer.vue";
import FloatingLabel from "@/Components/Forms/FloatingLabel.vue";

const confirmingUserDeletion = ref(false);
const $passwordInput = ref(null);

const form = useForm({
	password: null,
});

const confirmUserDeletion = () => {
	confirmingUserDeletion.value = true;

	nextTick(() => $passwordInput.value.focus());
};

const deleteUser = () => {
	form.delete("/profile", {
		//route("profile.destroy"), {
		preserveScroll: true,
		onSuccess: () => closeModal(),
		onError: () => $passwordInput.value.focus(),
		onFinish: () => form.reset(),
	});
};

const closeModal = () => {
	confirmingUserDeletion.value = false;

	form.reset();
};
</script>

<template>
	<section class="space-y-6">
		<header>
			<h2 class="pb-3 font-means-web text-2xl font-bold">Delete account</h2>

			<p class="mt-1 text-sm text-skin-text-muted">
				Once your account is deleted, all of its resources and data will be
				permanently deleted. Before deleting your account, please download any
				data or information that you wish to retain.
			</p>
		</header>

		<button
			class="button !bg-skin-danger text-skin-white"
			@click="confirmUserDeletion"
		>
			Delete account
		</button>

		<ModalContainer
			modal-id="modal-delete-account"
			modal-title="Are you sure you want to delete your account?"
			:show="confirmingUserDeletion"
			@close="closeModal"
		>
			<p class="mt-1 text-skin-text-muted">
				Once your account is deleted, all of its resources and data will be
				permanently deleted. Please enter your password to confirm you would
				like to permanently delete your account.
			</p>

			<FloatingLabel
				ref="$passwordInput"
				v-model:value="form.first_name"
				class="mt-6 block w-3/4"
				input-id="password"
				label-text="Password"
				input-type="password"
				input-autocomplete="off"
				:error-message="form.errors.password"
				@keyup.enter="deleteUser"
			/>

			<div class="mt-6 flex justify-end space-x-4">
				<button
					class="button !bg-skin-text-muted text-skin-white"
					@click="closeModal"
				>
					Cancel
				</button>

				<button
					class="button !bg-skin-danger text-skin-white"
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
					@click="deleteUser"
				>
					Delete account
				</button>
			</div>
		</ModalContainer>
	</section>
</template>
