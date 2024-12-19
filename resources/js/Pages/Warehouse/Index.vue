<script setup>
import { ref, computed } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import { toast } from '@/Utils/toaster'
import { txt } from '@/Utils/helpers'

import { useDeleteForm } from '@/Composables/DeleteForm'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import Button from '@/Components/Elements/Button.vue'
import TableInfo from '@/Components/Table/TableInfo.vue'
import FilterTags from '@/Components/Table/FilterTags.vue'
import Tag from '@/Components/Elements/Tag.vue'
import DataTable from '@/Components/Table/DataTable.vue'
import Column from '@/Components/Table/Column.vue'
import Modal from '@/Components/Modals/Modal.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import TextareaInput from '@/Components/Inputs/TextareaInput.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'
import AddChangeModal from './Partials/AddChangeModal.vue'
import Icon from '@/Components/Elements/Icon.vue'
import InputsRow from '@/Components/Inputs/InputsRow.vue'
import NumberInput from '@/Components/Inputs/NumberInput.vue'
import BasicSelectInput from '@/Components/Inputs/BasicSelectInput.vue'

const props = defineProps({
	items: Array
})

const filter = ref('')
const filteredItems = computed(() => {
	return props.items.filter(item => [item.name, item.code].some(i => i?.toLocaleLowerCase()?.includes(filter.value.toLocaleLowerCase())))
})

const unitOptions = [txt('pc'), 'kg', 'm', 'l']

const newItemModal = ref(false)
const form = useForm({
	name: '',
	code: '',
	unit: txt('pc'),
	quantity: 1,
	note: ''
})
function openNewItemModal() {
	form.clearErrors()
	form.reset()
	newItemModal.value = true
}
function submit() {
	form.clearErrors()
	form.post('/warehouse', {
		preserveScroll: true,
		onSuccess: (data) => {
			toast.success(txt('Item created'), {
				onClick: () => {
					if (data?.props?.flash?.id) router.visit(`/warehouse/${data.props.flash.id}`)
					else return
				}
			})
			form.reset()
			newItemModal.value = false
		}
	})
}

const { deletingIDs, deleteItem: deleteItemAction } = useDeleteForm()

function deleteItem(item) {
	if (!item.id) return

	deleteItemAction(item.id, `/warehouse/${item.id}`, {
		dialogText: txt('removeItemQuestion', 'Are you sure you want to remove the item <strong>#0#</strong> from the warehouse?', [item.name]),
		onSuccess: () => router.reload({ preserveScroll: true, only: ['items'] })
	})
}

const changeModalRef = ref(null)

function getTooltipText(item) {
	let arr = []
	if (item.note) arr.push(item.note)
	if (item.code) arr.push(`<span class="text-light">${txt('Code')}: ${item.code}</span>`)
	return arr.join('<br>')
}
</script>

<template>
	<AuthenticatedLayout :header="txt('Warehouse')">
		<Card>
			<TableInfo v-if="items?.length" :count="filteredItems?.length" :countWords="[txt('item'), txt('items2', 'items'), txt('items')]">
				<TextInput placeholder="Filter..." v-model="filter" icon="search" clearable />
				<template #buttons>
					<Button icon="plus" @click.prevent="openNewItemModal">{{ txt('Add item') }}</Button>
				</template>
			</TableInfo>
			<FilterTags>
				<Tag v-if="filter" @click="filter = ''" clearable>Filter: {{ filter }}</Tag>
			</FilterTags>
			<DataTable :items="filteredItems" :itemWord="txt('items2', 'items')" :loadingRows="deletingIDs" modelField="id">
				<template #empty>
					<Button v-if="filter" icon="x" variant="outline" @click="filter = ''">{{ txt('Reset filter') }}</Button>
					<Button v-else icon="plus" size="bigger" @click.prevent="openNewItemModal">{{ txt('Add item') }}</Button>
				</template>
				<Column :header="txt('Title')" field="name" link="/warehouse" linkParam="id" minWidth="7rem" />
				<Column align="center" :header="txt('Quantity')">
					<template #default="{ data }">{{ data.quantity.toLocaleString('SK') }} {{ data.unit }}</template>
				</Column>
				<Column :header="txt('Updated')" field="updated_at" type="date" />
				<Column v-if="items.some(item => item.note || item.code)" type="icon">
					<template #default="{ data }">
						<Icon v-if="data.note || data.code" name="circle-info" v-tooltip.touch="getTooltipText(data)" />
					</template>
				</Column>
				<Column type="buttons">
					<template #default="{ data }">
						<IcoButton icon="plusminus" v-tooltip="txt('Add change')" @click.stop="changeModalRef.showChangeModal(data)" />
						<IcoButton link="/warehouse" :linkParam="data.id" icon="right" v-tooltip="'Detail'" />
						<IcoButton :loading="deletingIDs.includes(data.id)" icon="trash" color="danger" v-tooltip="txt('Delete')" @click.stop="deleteItem(data)" />
					</template>
				</Column>
			</DataTable>
			<template v-if="items.length" #footer>
				{{ txt('Export data to XLS') }}
			</template>
			<template v-if="items.length" #buttons>
				<Button icon="download" link="/warehouse/export" color="link" variant="outline" download>{{ txt('Warehouse') }}</Button>
				<Button icon="download" link="/warehouse/export?items=1" color="link" variant="outline" download>{{ txt('Warehouse with changes') }}</Button>
			</template>
		</Card>
	</AuthenticatedLayout>
	<Modal v-model:open="newItemModal" :header="txt('New item')" width="narrow" :closeable="!form.processing" as="form" @submit.prevent="submit">
		<TextInput
			:label="txt('Title')"
			:placeholder="txt('Pump XY')"
			autofocus
			required
			v-model="form.name"
			:error="form.errors.name"
		/>
		<TextInput
			:label="txt('Code')"
			:placeholder="`abcd-1234 (${txt('optional')})`"
			v-model="form.code"
			:error="form.errors.code"
		/>
		<InputsRow>
			<NumberInput
				class="grow"
				:label="txt('Quantity')"
				type="number"
				:step="form?.unit == 'ks' || form?.unit == 'pc' ? 1 : 0.001"
				:inc="form?.unit == 'ks' || form?.unit == 'pc' ? 1 : 0.1"
				required
				v-model="form.quantity"
				:error="form.errors.quantity"
			/>
			<BasicSelectInput
				:label="txt('Unit')"
				:options="unitOptions"
				v-model="form.unit"
				:error="form.errors.unit"
			/>
		</InputsRow>
		<TextareaInput
			:label="txt('Note')"
			:placeholder="`${txt('Note to item...')} (${txt('optional')})`"
			rows="3"
			v-model="form.note"
			:error="form.errors.note"
		/>
		<p>
			<Button type="submit" full :loading="form.processing">{{ txt('Save item') }}</Button>
		</p>
	</Modal>
	<AddChangeModal ref="changeModalRef" />
</template>