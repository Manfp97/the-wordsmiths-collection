<script setup>
const value = defineModel("value"); // eslint-disable-line

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
	autocomplete: {
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
				v-model="value"
				:type="type"
				class="peer block w-full appearance-none rounded-lg border border-skin-border bg-skin-primary-offset px-2.5 pb-2.5 pt-5 text-sm text-skin-text focus:border-skin-secondary focus:outline-none focus:ring-2 focus:ring-skin-secondary"
				:class="{
					'border-skin-success': successMessage,
					'border-skin-danger': errorMessage,
				}"
				placeholder=" "
				:autocomplete="autocomplete"
				:aria-errormessage="errorMessage ? `${id}-error` : null"
				:aria-invalid="errorMessage ? true : false"
				:aria-describedby="`${id}-annotation`"
			/>
			<label
				:for="id"
				class="input-filled cursor-text text-skin-text-muted peer-placeholder-shown:top-4 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:top-5 peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:text-skin-text rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4"
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
			class="mt-2 text-xs text-skin-danger"
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
