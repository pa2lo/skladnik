<script setup>
import { ref, computed } from 'vue'

import { toast } from '@/Utils/toaster'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import Modal from '@/Components/Modals/Modal.vue'
import Button from '@/Components/Elements/Button.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'
import TableProps from './Partials/TableProps.vue'
import Accordion from '@/Components/Elements/Accordion.vue'

import TableInfo from '@/Components/Table/TableInfo.vue'
import FilterTags from '@/Components/Table/FilterTags.vue'
import DataTable from '@/Components/Table/DataTable.vue'
import Column from '@/Components/Table/Column.vue'
import Icon from '@/Components/Elements/Icon.vue'
import Pagination from '@/Components/Elements/Pagination.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import Tag from '@/Components/Elements/Tag.vue'

const paginationLinks = [
	{
		"url": null,
		"label": "&laquo; Previous",
		"active": false
	},
	{
		"url": "#page=1",
		"label": "1",
		"active": true
	},
	{
		"url": "#page=2",
		"label": "2",
		"active": false
	},
	{
		"url": "#page=3",
		"label": "3",
		"active": false
	},
	{
		"url": "#page=4",
		"label": "4",
		"active": false
	},
	{
		"url": "#page=5",
		"label": "5",
		"active": false
	},
	{
		"url": "#page=6",
		"label": "6",
		"active": false
	},
	{
		"url": "#page=10",
		"label": "10",
		"active": false
	},
	{
		"url": null,
		"label": "...",
		"active": false
	},
	{
		"url": "#page=2139",
		"label": "2139",
		"active": false
	},
	{
		"url": "#page=2140",
		"label": "2140",
		"active": false
	},
	{
		"url": "#page=2",
		"label": "Next &raquo;",
		"active": false
	}
]

const tableDataFilter = ref('')
const tableData = ref([
	{
		id: 'item1',
		name: 'Item 1',
		value: 70,
		created: 1710408361547
	}, {
		id: 'item2',
		name: 'Item 2',
		value: 30,
		created: 1710508361547
	}
])
const filteredTableData = computed(() => {
	return tableData.value.filter(i => (i.name).toLowerCase().includes(tableDataFilter.value.toLowerCase()))
})
function addItemToTableData() {
	let now = Date.now()
	let name = `Item ${tableData.value.length + 1}`
	tableData.value.push({
		id: now,
		name: name,
		value: Math.floor(Math.random() * 100),
		created: now
	})
	toast.success(`Item added`, {message: name})
}
function deleteItemFromTableData(data) {
	let index = tableData.value.findIndex(i => i.id == data.id)
	if (index == -1) return

	tableData.value.splice(index, 1)
	toast.success(`Item deleted`, {message: data.name})
}

const showPaginationInfo = ref(false)
const paginationCodeExample = `const paginationLinks = [
 {
  "url": null,
  "label": "&laquo; Previous",
  "active": false
 },
 {
  "url": "#page=1",
  "label": "1",
  "active": true
 },
 {
  "url": "#page=2",
  "label": "2",
  "active": false
 }
]

<Pagination
 :links="paginationLinks"
 :currentPage="1"
 :prevPage="'#prev'"
 :nextPage="'#next'"
 :firstPage="'#first'"
 :lastPage="'#last'"
 :pages="10"
 :from="1"
 :to="10"
 :total="100"
/>`
const paginationProps = [
	{
		name: 'links',
		type: 'Array',
		note: 'structure in code example'
	}, {
		name: 'pages',
		type: 'Number'
	}, {
		name: 'currentPage',
		type: 'Number'
	}, {
		name: 'prevPage',
		type: 'String'
	}, {
		name: 'nextPage',
		type: 'String'
	}, {
		name: 'firstPage',
		type: 'String'
	}, {
		name: 'lastPage',
		type: 'String'
	}, {
		name: 'from',
		type: 'Number'
	}, {
		name: 'to',
		type: 'Number'
	}, {
		name: 'total',
		type: 'Number'
	}
]

const showTableInfoInfo = ref(false)
const tableInfoCodeExample = `<TableInfo :count="data.length">
 <TextInput placeholder="Filter..." v-model="filter" icon="search" clearable />
 <template #buttons>
  <Button icon="plus" @click="addItem">Add item</Button>
 </template>
</TableInfo>`
const tableInfoProps = [
	{
		name: 'count',
		type: 'Number'
	}, {
		name: 'countWords',
		type: 'Array',
		default: '["record", "records", "records"]',
		note: 'array of words for 1, 2-5, 5+ items'
	}
]
const tableInfoSlots = [
	{
		name: 'default',
		note: 'left content'
	}, {
		name: 'buttons',
		note: 'right buttons'
	}
]

const showDataTableInfo = ref(false)
const dataTableCodeExample = `const items = [
 {
  name: 'Item 1',
  value: 70,
  created: 1710408361547
 }, {
  name: 'Item 2',
  value: 30,
  created: 1710308361547
 }
]

<DataTable :items="filteredTableData">
 <Column type="icon">
  <template #default="{ data }">
   <Icon :name="data.value > 50 ? 'circle-check' : 'circle-x'" />
  </template>
 </Column>
 <Column header="Name" field="name" link="dashboard" />
 <Column header="Value" field="value" align="center" />
 <Column header="Date" field="created" type="date" />
 <Column type="buttons">
  <template #default="{ data }">
   <IcoButton icon="edit" @click="action(data)" v-tooltip="'Edit'" />
   <IcoButton icon="trash" color="danger" @click="deleteItemFromTableData(data)" v-tooltip="'Delete'" />
  </template>
 </Column>
</DataTable>`
const dataTableProps = [
	{
		name: 'items',
		type: 'Array'
	}, {
		name: 'rowClick',
		type: 'Function'
	}, {
		name: 'itemWord',
		type: 'String',
		default: 'data',
		note: 'label for no items'
	}
]
const tableColumnProps = [
	{
		name: 'header',
		type: 'String'
	}, {
		name: 'type',
		type: 'String',
		default: 'default',
		note: 'available: default | date | icon | buttons'
	}, {
		name: 'field',
		type: 'String',
		note: 'key of item object'
	}, {
		name: 'link',
		type: 'String'
	}, {
		name: 'linkParam',
		type: 'String',
		note: 'link parameter'
	}, {
		name: 'align',
		type: 'String',
		default: 'left',
		note: 'available: left | center | right<br>defaults to center in date type'
	}, {
		name: 'cellClass',
		type: 'String'
	}, {
		name: 'minWidth',
		type: 'String',
		note: 'with rem | em | px | %'
	}, {
		name: 'colClick',
		type: 'Funcion'
	}
]
const dataTableSlots = [
	{
		name: 'emptyCont',
		default: 'countWord and empty slot',
		note: 'no data text'
	}, {
		name: 'empty',
		note: 'no data addon'
	}, {
		name: 'default',
		note: 'only Column components rendered'
	}
]
const tableColumnSlots = [
	{
		name: 'default',
		scope: 'data',
		note: 'item scoped slot'
	}
]

const showFilterTagsInfo = ref(false)
const filterTagsCodeExample = `<FilterTags>
 <Tag v-if="filter" clearable @click="filter = ''">Filter: {{ filter }}</Tag>
</FilterTags>`
const filterTagsSlots = [
	{
		name: 'default',
		note: 'tags'
	}
]
</script>

<template>
	<AuthenticatedLayout header="Data table">
		<Card header="TableInfo">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showTableInfoInfo = true" />
			</template>
			<TableInfo :count="filteredTableData.length">
				<TextInput placeholder="Filter..." v-model="tableDataFilter" icon="search" clearable />
				<template #buttons>
					<Button icon="plus" @click="addItemToTableData">Add new</Button>
				</template>
			</TableInfo>
			<Modal v-model:open="showTableInfoInfo" header="TableInfo component">
				<div>
					<Accordion title="Code example" pre>
						{{ tableInfoCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="tableInfoProps" />
				<TableProps header="Slots" :properties="tableInfoSlots" />
			</Modal>
		</Card>
		<Card header="FilterTags">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showFilterTagsInfo = true" />
			</template>
			<FilterTags>
				<Tag clearable>Tag</Tag>
				<Tag v-if="tableDataFilter" clearable @click="tableDataFilter = ''">Filter: {{ tableDataFilter }}</Tag>
			</FilterTags>
			<Modal v-model:open="showFilterTagsInfo" header="FilterTags component">
				<div>
					<Accordion title="Code example" pre>
						{{ filterTagsCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Slots" :properties="filterTagsSlots" />
			</Modal>
		</Card>
		<Card header="DataTable">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showDataTableInfo = true" />
			</template>
			<DataTable :items="filteredTableData">
				<template v-if="tableDataFilter && tableData.length" #emptyCont>
					<h3>No results for "{{ tableDataFilter }}"</h3>
					<p><Button icon="x" variant="outline" @click="tableDataFilter = ''">Reset filter</Button></p>
				</template>
				<template #empty>
					<Button v-if="!tableData.length" icon="plus" size="bigger" @click="addItemToTableData">Add item</Button>
				</template>
				<Column type="icon">
					<template #default="{ data }">
						<Icon v-if="data.value > 50" class="color-success" name="circle-check" v-tooltip="'more than 50'" />
						<Icon v-else class="color-error" name="circle-x" />
					</template>
				</Column>
				<Column header="Name" field="name" link="dashboard" />
				<Column header="Value" align="center" field="value" />
				<Column header="Date" type="date" field="created" />
				<Column type="buttons">
					<template #default="{ data }">
						<IcoButton icon="edit" @click="toast.info(`Edit item`, {message: data.name})" v-tooltip="'Edit'" />
						<IcoButton icon="trash" color="danger" @click="deleteItemFromTableData(data)" v-tooltip="'Delete'" />
					</template>
				</Column>
			</DataTable>
			<Modal v-model:open="showDataTableInfo" header="DataTable component">
				<div>
					<Accordion title="Code example" pre>
						{{ dataTableCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props - DataTable" :properties="dataTableProps" />
				<TableProps header="Slots - DataTable" :properties="dataTableSlots" />
				<TableProps header="Props - Column" :properties="tableColumnProps" />
				<TableProps header="Slots - Column" :properties="tableColumnSlots" />
			</Modal>
		</Card>
		<Card header="Pagination">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showPaginationInfo = true" />
			</template>
			<Pagination
				:links="paginationLinks"
				:currentPage="1"
				:prevPage="'#prev'"
				:nextPage="'#next'"
				:firstPage="'#first'"
				:lastPage="'#last'"
				:pages="10"
				:from="1"
				:to="10"
				:total="100"
			/>
			<Modal v-model:open="showPaginationInfo" header="Pagination component">
				<div>
					<Accordion title="Code example" pre>
						{{ paginationCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="paginationProps" />
			</Modal>
		</Card>
	</AuthenticatedLayout>
</template>