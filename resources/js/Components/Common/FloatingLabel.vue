<script setup>
defineProps({
	id: {
		type: String,
		required: true,
	},
	labelText: {
		type: String,
		required: true,
	},
	type: {
		type: String,
		required: true,
	},
	successMessage: {
		type: String,
		required: false,
		default: null,
	},
	errorMessage: {
		type: String,
		required: false,
		default: null,
	},
});
</script>

<template>
	<div>
		<div class="relative">
			<input
				:id="id"
				:type="type"
				class="bg-skin-primary-offset peer block w-full appearance-none rounded-lg border border-skin-border px-2.5 pb-2.5 pt-5 text-sm text-skin-text focus:border-skin-secondary focus:outline-none focus:ring-2 focus:ring-skin-secondary"
				:class="{
					'border-skin-success': successMessage,
					'border-skin-alert': errorMessage,
				}"
				placeholder=" "
				:aria-describedby="`${id}-annotation`"
			/>
			<label
				:for="id"
				class="text-skin-text-muted input-filled cursor-text peer-placeholder-shown:top-4 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:top-5 peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:text-skin-text rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4"
			>
				{{ labelText }}
			</label>
		</div>

		<p
			v-if="successMessage"
			:id="`${id}-success`"
			class="mt-2 text-xs text-skin-success"
		>
			{{ successMessage }}
		</p>

		<p
			v-if="errorMessage"
			:id="`${id}-error`"
			class="mt-2 text-xs text-skin-alert"
		>
			{{ errorMessage }}
		</p>
	</div>
</template>

<style scoped>
.input-filled {
	@apply absolute start-2.5 top-5 z-10 origin-[0] -translate-y-4 scale-75 transform text-sm duration-300;
}

input:-webkit-autofill ~ label {
	@apply input-filled;
}
</style>
