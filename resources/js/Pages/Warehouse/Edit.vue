<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { formatDate, txt } from '@/Utils/helpers'
import { toast } from '@/Utils/toaster'
import { dialog } from '@/Utils/dialog'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import Button from '@/Components/Elements/Button.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'
import TableInfo from '@/Components/Table/TableInfo.vue'
import DataTable from '@/Components/Table/DataTable.vue'
import Column from '@/Components/Table/Column.vue'
import Modal from '@/Components/Modals/Modal.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import TextareaInput from '@/Components/Inputs/TextareaInput.vue'
import AddChangeModal from './Partials/AddChangeModal.vue'

const props = defineProps({
	item: Object,
	history: Array
})

const editModal = ref(false)
const editForm = useForm({
	name: props.item.name,
	note: props.item.note,
	code: props.item.code
})
function showEditModal() {
	editForm.clearErrors()
	editForm.reset()
	editModal.value = true
}
function submitEdit() {
	editForm.clearErrors()
	editForm.patch(`/warehouse/${props.item.id}`, {
		preserveScroll: true,
		onSuccess: () => {
			toast.success(txt('Item edited'))
			editModal.value = false
		}
	})
}

const deleteForm = useForm({})
function deleteItem() {
	dialog.delete(txt('Delete item'), txt('removeItemQuestion', 'Are you sure you want to remove the item <strong>#0#</strong> from the warehouse?', [props.item.name]), {
		onConfirm: () => {
			deleteForm.delete(`/warehouse/${props.item.id}`, {
				preserveScroll: true,
				onSuccess: () => toast.success(txt('Item deleted'))
			})
		}
	})
}

const noteModal = ref(false)
const noteId = ref(null)
const noteForm = useForm({
	note: ''
})
function showNoteModal(item) {
	if (!item.id) return

	noteId.value = item.id
	noteForm.note = item.note

	noteModal.value = true
}
function submitNote() {
	noteForm.patch(`/changes/${noteId.value}`, {
		preserveScroll: true,
		onSuccess: () => {
			toast.success(txt('Note edited'))
			noteModal.value = false
		}
	})
}

function printPage() {
	window.print()
}

const changeModalRef = ref(null)
</script>

<template>
	<AuthenticatedLayout :header="`${item?.name}`" backLink="/">
		<Card :header="txt('Item detail')" :headerNote="item.code ? `${txt('Code')}: ${item.code}` : ''">
			<template #actions>
				<Button size="compact" icon="edit" variant="outline" color="link" @click.prevent="showEditModal">{{ txt('Edit') }}</Button>
				<!-- <IcoButton size="compact" icon="edit" variant="outline" color="link" @click.prevent="showEditModal">{{ txt('Edit') }}</IcoButton> -->
			</template>
			<p v-if="item.note">{{ item.note }}</p>
			<TableInfo>
				<h5>{{ txt('Current state') }}: {{ item.quantity.toLocaleString('SK') }} {{ item.unit }}</h5>
				<template #buttons>
					<Button icon="plusminus" @click.prevent="changeModalRef.showChangeModal(item)">{{ txt('Add change') }}</Button>
				</template>
			</TableInfo>
			<DataTable :items="history">
				<Column :header="txt('Change')">
					<template #default="{ data }">{{ data.change > 0 ? `+${data.change.toLocaleString('SK')}` : data.change.toLocaleString('SK') }}</template>
				</Column>
				<Column :header="txt('Note')" field="note" />
				<Column :header="txt('Datetime')" field="time" type="date" />
				<Column align="center" :header="txt('Changed by')">
					<template #default="{ data }">{{ data?.author?.name || '-' }}</template>
				</Column>
				<Column type="buttons">
					<template #default="{ data }">
						<IcoButton icon="edit" v-tooltip="txt('Edit note')" @click.stop="showNoteModal(data)" />
					</template>
				</Column>
			</DataTable>
			<template #footer>
				<div class="smaller">
					<div>{{ txt('Added') }}: <strong class="nowrap">{{ formatDate(item.created_at) }}</strong></div>
					<div>{{ txt('Updated') }}: <strong class="nowrap">{{ formatDate(item.updated_at) }}</strong></div>
				</div>
			</template>
			<template #buttons>
				<Button icon="download" :link="`/warehouse/${item.id}/export`" variant="outline" color="link" download>{{ txt('Download') }}</Button>
				<Button icon="print" variant="outline" color="link" @click.prevent="printPage">{{ txt('Print') }}</Button>
				<!-- <Button icon="edit" variant="outline" color="link" @click.prevent="showEditModal">{{ txt('Edit') }}</Button> -->
				<Button color="danger" icon="trash" variant="outline" @click.prevent="deleteItem" :loading="deleteForm.processing">{{ txt('Delete') }}</Button>
			</template>
		</Card>
	</AuthenticatedLayout>
	<Modal v-model:open="editModal" :header="txt('Edit item')" width="narrow" :closeable="!editForm.processing" as="form" @submit.prevent="submitEdit">
		<TextInput
			:label="txt('Title')"
			:placeholder="txt('Pump XY')"
			autofocus
			required
			v-model="editForm.name"
			:error="editForm.errors.name"
		/>
		<TextInput
			:label="txt('Code')"
			:placeholder="`abcd-1234 (${txt('optional')})`"
			v-model="editForm.code"
			:error="editForm.errors.code"
		/>
		<TextareaInput
			:label="txt('Note')"
			:placeholder="`${txt('Note to item...')} (${txt('optional')})`"
			v-model="editForm.note"
			:error="editForm.errors.note"
			rows="3"
		/>
		<p>
			<Button type="submit" full :loading="editForm.processing">{{ txt('Save item') }}</Button>
		</p>
	</Modal>
	<Modal v-model:open="noteModal" :header="txt('Edit note')" width="narrow" :closeable="!noteForm.processing" as="form" @submit.prevent="submitNote">
		<TextareaInput
			:label="txt('Note')"
			placeholder="Naskladnené... (nepovinné)"
			autofocus
			rows="3"
			v-model="noteForm.note"
			:error="noteForm.errors.note"
		/>
		<p>
			<Button type="submit" full :loading="noteForm.processing">{{ txt('Save note') }}</Button>
		</p>
	</Modal>
	<AddChangeModal ref="changeModalRef" />
</template>