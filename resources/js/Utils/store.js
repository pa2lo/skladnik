import { ref } from "vue"

export const installInit = ref(false)
export const installPrompt = ref(null)

export function installApp() {
	if (!installPrompt.value) return
	installPrompt.value.prompt()
	installPrompt.value.userChoice.then(outcome => {
		if (outcome === 'accepted') installPrompt.value = null
	})
}