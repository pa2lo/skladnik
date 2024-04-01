<script setup>
import { onMounted } from 'vue'
import { Head } from '@inertiajs/vue3'
import { installInit, installPrompt, installApp } from '@/Utils/store'

import ApplicationLogo from '@/Components/Elements/ApplicationLogo.vue'
import Card from '@/Components/Elements/Card.vue'

defineProps({
	width: String,
	header: String
})

onMounted(() => {
	if (!installInit.value) {
		installInit.value = true
		window.addEventListener('beforeinstallprompt', (e) => {
			e.preventDefault()
			installPrompt.value = e
		})
	}
})
</script>

<template>
	<Head :title="header" />
	<div class="guest-layout flex aj-c">
		<div class="guest-logo ta-c">
			<ApplicationLogo />
		</div>
		<Card :width="width || 'narrow'">
			<h2>{{ header }}</h2>
			<slot />
		</Card>
	</div>
</template>