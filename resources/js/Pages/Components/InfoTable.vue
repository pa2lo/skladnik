<script setup>
import { ref, computed } from 'vue'
import { toast } from '@/Utils/toaster'
import { dialog } from '@/Utils/dialog'

import { useStorage } from '@/Composables/BrowserStorage'
import { useAppForms } from '@/Composables/AppForms'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'
import Modal from '@/Components/Modals/Modal.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import Button from '@/Components/Elements/Button.vue'
import TableInfo from '@/Components/Table/TableInfo.vue'

const keysMap = {
	name: "Some key",
	second: "Second",
	zip: "ZIP",
	country: "Country",
	key5: "Last key"
}
const data = ref([
	{
		id: 1,
		name: "This is row",
		second: "not given",
		zip: "12345",
		country: "Rwanda",
		key5: "locked"
	}, {
		id: 2,
		name: "Second row",
		second: "special name",
		zip: "98765",
		key5: "free"
	}, {
		id: 3,
		name: "Custom name",
		zip: "13468",
		country: "Canada",
		key5: "subscription"
	}, {
		id: 4,
		name: "Last row",
		second: "hmmm",
		country: "Egypt",
		key5: "random"
	}
])

const fields = useStorage('demo-fields', Object.keys(keysMap))
const orientation = useStorage('demo-orientation', 'row')

const hasCustomOrder = computed(() => fields.value.toString() != Object.keys(keysMap).toString())

// sort arrows
function moveField(up = false, index) {
	const newIndex = up ? index-1 : index+1
    fields.value.splice(newIndex, 0, fields.value.splice(index, 1)[0])
}

// drag&drop events
const dragAllowed = ref(false)
const dragIndex = ref(null)
const dragHoverIndex = ref(null)
const dragID = ref(null)
function onDragStart(e, index, id) {
	if (id == 'fields' && !dragAllowed.value) e.preventDefault()
	dragIndex.value = index
	dragID.value = id
}
function onDragEnter(e, index) {
	if (index === dragIndex.value) return
	e.preventDefault()
	dragHoverIndex.value = index
}
function onDragLeave(e, index) {
	if (!e.currentTarget.contains(e.relatedTarget) && index == dragHoverIndex.value) dragHoverIndex.value = null
}
function onDragOver(e, index) {
	if (index != dragIndex.value) e.preventDefault()
}
function onDrop(e, index) {
	fields.value.splice(index, 0, fields.value.splice(dragIndex.value, 1)[0])
	clearDragVars()
}
function clearDragVars() {
	dragHoverIndex.value = null
	dragIndex.value = null
	dragID.value = null
}

// data form
const { activeForm, showModal, showEditForm, showNewForm } = useAppForms(Object.keys(keysMap).reduce((acc, item) => {
	acc[item] = ''
	return acc
}, {}))
function submitForm() {
	activeForm.value.type == 'newForm' ? addRecord() : editRecord()
}
function addRecord() {
	const newRecord = {id: Date.now()}
	Object.keys(keysMap).forEach(key => {
		newRecord[key] = activeForm.value.form[key] || ''
	})
	data.value.push(newRecord)
	onRecordSubmit('Record added')
}
function editRecord() {
	if (!activeForm.value.form?.id) return
	const index = data.value.findIndex(d => d.id == activeForm.value.form.id)
	Object.keys(keysMap).forEach(key => {
		data.value[index][key] = activeForm.value.form[key] || ''
	})
	onRecordSubmit('Record updated')
}
function onRecordSubmit(message) {
	toast.success(message)
	showModal.value = false
}

function cloneRecord(index) {
	let newItem = Object.assign({...JSON.parse(JSON.stringify(data.value[index])), id: Date.now()})
	data.value.splice(index+1, 0, newItem)
}

function deleteRecord(index) {
	dialog.delete(null, 'Are you sure you want to delete record?', {
		onConfirm: () => {
			data.value.splice(index, 1)
			toast.success('Record deleted')
		}
	})
}

const editCellModal = ref(false)
const editCellData = ref({
	index: null,
	key: null,
	model: null
})
function showEditCell(index, key) {
	editCellData.value = {
		index, key, model: data.value[index][key] || ''
	}
	editCellModal.value = true
}
function submitEditCell() {
	data.value[editCellData.value.index][editCellData.value.key] = editCellData.value.model || ''
	editCellModal.value = false
}
</script>

<template>
	<AuthenticatedLayout header="InfoTable">
		<Card header="Table with class infoTable">
			<p>Table with sortable columns. Usage of .infoTable table with useStorage composable. Look at the Components/InfoTable.vue file on github.</p>
			<h3>Fields</h3>
			<div class="dataTable-wrapper line">
				<table class="infoTable">
					<thead>
						<tr>
							<th>Name</th>
							<th>Key</th>
							<th class="infoTable-buttons infoTable-sticky-right">
								<IcoButton v-if="hasCustomOrder" icon="refresh" v-tooltip="'Reset order'" @click.prevent="fields = Object.keys(keysMap)" />
							</th>
						</tr>
					</thead>
					<tbody>
						<tr
							v-for="(key, index) in fields"
							:class="{
								'row-drop': dragID == 'fields' && dragHoverIndex == index,
								'row-dragged': dragID == 'fields' && dragIndex == index
							}"
							draggable="true"
							@dragstart="onDragStart($event, index, 'fields')"
							@dragenter="onDragEnter($event, index)"
							@dragover="onDragOver($event, index)"
							@dragleave="onDragLeave($event, index)"
							@drop="onDrop($event, index)"
							@dragend="clearDragVars"
						>
							<td class="infoTable-highlight-onRow">
								{{ keysMap[key] }}
							</td>
							<td class="infoTable-highlight-onRow">
								{{ key }}
							</td>
							<td class="infoTable-buttons infoTable-sticky-right">
								<IcoButton :invisible="index == 0" icon="up" @click="moveField(true, index)" />
								<IcoButton :invisible="index == fields.length -1" icon="down" @click="moveField(false, index)" />
								<IcoButton class="isMovable touch-hide" icon="move" @pointerdown="dragAllowed = true" @pointerup="dragAllowed = false" @pointercancel="dragAllowed = false" />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<h3 class="divided">Data</h3>
			<TableInfo>
				<p>Drag&Drop table headers and switchable columns and rows. Operations uses useAppForms composable.</p>
				<template #buttons>
					<Button icon="plus" @click="showNewForm">Add record</Button>
				</template>
			</TableInfo>
			<div class="dataTable-wrapper line">
				<table v-if="orientation == 'row'" class="infoTable">
					<thead>
						<tr>
							<th
								v-for="(key, index) in fields"
								class="infoTable-default isMovable"
								:class="{
									'col-drop': dragID == 'data' && dragHoverIndex == index,
									'col-dragged': dragID == 'data' && dragIndex == index
								}"
								draggable="true"
								@dragstart="onDragStart($event, index, 'data')"
								@dragenter="onDragEnter($event, index)"
								@dragover="onDragOver($event, index)"
								@dragleave="onDragLeave($event, index)"
								@drop="onDrop($event, index)"
								@dragend="clearDragVars"
							>
								{{ keysMap[key] }}
							</th>
							<th class="infoTable-buttons infoTable-sticky-right">
								<IcoButton v-if="hasCustomOrder" icon="refresh" v-tooltip="'Reset order'" @click.prevent="fields = Object.keys(keysMap)" />
								<IcoButton icon="table-col" v-tooltip="'Rotate table'" @click.prevent="orientation = 'col'" />
							</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(row, i) in data">
							<td
								v-for="(key, index) in fields"
								class="infoTable-highlight isClickable"
								:class="{
									'col-drop': dragID == 'data' && dragHoverIndex == index,
									'col-dragged': dragID == 'data' && dragIndex == index
								}"
								@click.prevent="showEditCell(i, key)"
							>
								{{ row[key] }}
							</td>
							<td class="infoTable-buttons infoTable-sticky-right">
								<IcoButton icon="edit" v-tooltip="'Edit'" @click="showEditForm(row)" />
								<IcoButton icon="copy" v-tooltip="'Clone'" @click="cloneRecord(i)" />
								<IcoButton v-if="data.length > 1" icon="trash" color="danger" v-tooltip="'Delete'" @click="deleteRecord(i)" />
							</td>
						</tr>
					</tbody>
				</table>
				<table v-else class="infoTable">
					<tbody>
						<tr
							v-for="(key, index) in fields"
							:class="{
								'row-drop': dragID == 'data' && dragHoverIndex == index,
								'row-dragged': dragIndex == index
							}"
						>
							<td
								class="infoTable-th isMovable infoTable-sticky-left"
								draggable="true"
								@dragstart="onDragStart($event, index, 'data')"
								@dragenter="onDragEnter($event, index)"
								@dragover="onDragOver($event, index)"
								@dragleave="onDragLeave($event, index)"
								@drop="onDrop($event, index)"
								@dragend="clearDragVars"
							>
								{{ keysMap[key] }}
							</td>
							<td
								v-for="(row, i) in data"
								class="infoTable-highlight isClickable"
								@click.prevent="showEditCell(i, key)"
							>
								{{ row[key] }}
							</td>
						</tr>
						<tr>
							<td class="infoTable-th infoTable-buttons infoTable-buttons-left infoTable-sticky-left">
								<IcoButton icon="table-row" v-tooltip="'Rotate table'" @click.prevent="orientation = 'row'" />
								<IcoButton v-if="hasCustomOrder" icon="refresh" v-tooltip="'Reset order'" @click.prevent="fields = Object.keys(keysMap)" />
							</td>
							<td v-for="(row, i) in data" class="infoTable-buttons infoTable-buttons-left">
								<IcoButton icon="edit" v-tooltip="'Edit'" @click="showEditForm(row)" />
								<IcoButton icon="copy" v-tooltip="'Clone'" @click="cloneRecord(i)" />
								<IcoButton v-if="data.length > 1" icon="trash" color="danger" v-tooltip="'Delete'" @click="deleteRecord(i)" />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</Card>
		<Modal v-model:open="showModal" width="narrow" :header="activeForm?.type == 'newForm' ? 'New record' : 'Edit record'" :headerNote="activeForm.type == 'editForm' ? `ID: ${activeForm.form.id}` : null" as="form" @submit.prevent="submitForm">
			<TextInput
				v-for="key in fields"
				:label="keysMap[key]"
				v-model="activeForm.form[key]"
				trim
				:required="key == 'name'"
			/>
			<div class="line">
				<Button full type="submit">{{ activeForm?.type == 'newForm' ? 'Add record' : 'Edit record' }}</Button>
			</div>
		</Modal>
		<Modal v-model:open="editCellModal" width="narrow" header="Edit field" as="form" @submit.prevent="submitEditCell">
			<TextInput
				:label="keysMap[editCellData.key]"
				v-model="editCellData.model"
				:required="editCellData.key == 'name'"
				:clearable="editCellData.key != 'name'"
				autofocus
				trim
			/>
			<div class="line">
				<Button full type="submit">Save</Button>
			</div>
		</Modal>
	</AuthenticatedLayout>
</template>