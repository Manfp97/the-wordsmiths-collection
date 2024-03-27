<script setup>
import Alert from "@/Components/Common/Alert.vue";
</script>

<template>
	<div class="flex min-h-screen flex-col">
		<slot />
		<Alert />
	</div>
</template>
