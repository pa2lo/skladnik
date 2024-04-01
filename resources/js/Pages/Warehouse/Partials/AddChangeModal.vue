<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { toast } from '@/Utils/toaster'
import { txt } from '@/Utils/helpers'

import Modal from '@/Components/Modals/Modal.vue'
import Button from '@/Components/Elements/Button.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import TextareaInput from '@/Components/Inputs/TextareaInput.vue'
import RadioButtons from '@/Components/Inputs/RadioButtons.vue'
import InputsRow from '@/Components/Inputs/InputsRow.vue'
import NumberInput from '@/Components/Inputs/NumberInput.vue'

const operationOptions = [
	{
		icon: 'plus',
		tooltip: 'Pripočítať',
		value: 'add'
	}, {
		icon: 'minus',
		tooltip: 'Odpočítať',
		value: 'subtract'
	}
]

const item = ref(null)

function getCurrentDateTime() {
	return new Date().toLocaleString('SV').split(':').slice(0, -1).join(':')
}

let currentDate = getCurrentDateTime()

const changeModal = ref(false)
const changeForm = useForm({
	operation: 'add',
	quantity: 1,
	note: '',
	time: currentDate
})
function showChangeModal(newItem) {
	item.value = newItem

	changeForm.clearErrors()
	changeForm.reset()
	changeModal.value = true
}
function submitChange() {
	if (!item.value?.id) return

	changeForm.transform(data => ({
		...data,
		quantity: data.operation == 'add' ? data.quantity : (data.quantity * -1),
		time: Math.floor(new Date(data.time).getTime() / 1000)
	})).patch(`/warehouse/${item.value.id}/change`, {
		preserveScroll: true,
		onSuccess: () => {
			toast.success(txt('Change saved'))
			changeForm.defaults('time', getCurrentDateTime())
			changeForm.reset()
			changeModal.value = false
		}
	})
}

defineExpose({ showChangeModal })
</script>

<template>
	<Modal v-model:open="changeModal" :header="txt('Add change')" :headerNote="item?.name" width="narrow" :closeable="!changeForm.processing" as="form" @submit.prevent="submitChange">
		<InputsRow>
			<RadioButtons
				label="Operácia"
				:options="operationOptions"
				v-model="changeForm.operation"
			/>
			<NumberInput
				class="grow"
				:label="txt('Quantity')"
				:step="item?.unit == 'ks' || item?.unit == 'pc' ? 1 : 0.001"
				:inc="item?.unit == 'ks' || item?.unit == 'pc' ? 1 : 0.1"
				:suffix="item.unit ?? null"
				required
				v-model="changeForm.quantity"
				:error="changeForm.errors.quantity"
			/>
		</InputsRow>
		<TextInput
			:label="txt('Datetime')"
			type="datetime-local"
			required
			v-model="changeForm.time"
			:error="changeForm.errors.time"
		/>
		<TextareaInput
			:label="txt('Note')"
			:placeholder="`${txt('Stocked...')} (${txt('optional')})`"
			rows="3"
			v-model="changeForm.note"
			:error="changeForm.errors.note"
		/>
		<p>
			<Button type="submit" full :loading="changeForm.processing">{{ txt('Save change') }}</Button>
		</p>
	</Modal>
</template>