<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { txt } from '@/Utils/helpers'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import Pagination from '@/Components/Elements/Pagination.vue'
import TableInfo from '@/Components/Table/TableInfo.vue'
import DataTable from '@/Components/Table/DataTable.vue'
import Column from '@/Components/Table/Column.vue'
import InputsRow from '@/Components/Inputs/InputsRow.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import SelectInput from '@/Components/Inputs/SelectInput.vue'
import SlideToggle from '@/Components/Elements/SlideToggle.vue'
import Button from '@/Components/Elements/Button.vue'
import Loader from '@/Components/Elements/Loader.vue'
import FilterTags from '@/Components/Table/FilterTags.vue'
import Tag from '@/Components/Elements/Tag.vue'

const props = defineProps({
	filters: Object,
	changes: Object,
	users: Array
})

const hasActiveFilter = Object.values(props.filters).some(v => v) ? true : false
const showInfo = props.changes?.data?.length || hasActiveFilter
const showFilter = ref(hasActiveFilter)

const filterValues = ref({
	from: props.filters?.from || '',
	to: props.filters?.to || '',
	name: props.filters?.name || '',
	by: props.filters?.by || ''
})

const usersMap = props.users.reduce((acc, user) => {
	acc[user.id] = user.name
	return acc
}, {})
const userListOptions = props.users.reduce((acc, user) => {
	acc.push({
		value: user.id,
		title: user.name
	})
	return acc
}, [])

const isLoading = ref(false)

function applyFilter() {
	let params = Object.entries(filterValues.value).reduce((obj, [ key, val ]) => {
		if (val && val != '') obj[key] = val
		return obj
	}, {})
	router.get(window.location.pathname, params, {
		preserveState: true,
		preserveScroll: true,
		onStart: () => isLoading.value = true,
		onFinish: () => isLoading.value = false
	})
}
function clearFilter() {
	Object.keys(filterValues.value).forEach(key => {
		filterValues.value[key] = ''
	})
	applyFilter()
}

let inputDebounce = null
function inputHit() {
	clearTimeout(inputDebounce)
	inputDebounce = setTimeout(() => {
		applyFilter()
	}, 500)
}

let todayDate = new Date().toLocaleDateString('en-ca')
</script>

<template>
	<AuthenticatedLayout :header="txt('List of changes')">
		<Card>
			<TableInfo v-if="showInfo" :count="changes?.total">
				<template #buttons>
					<Button icon="filter" @click.prevent="showFilter = !showFilter">Filter</Button>
				</template>
			</TableInfo>
			<SlideToggle class="line" :show="showFilter">
				<InputsRow wrap>
					<TextInput class="grow" icon="search" :placeholder="txt('Pump XY')" :label="txt('Item')" v-model="filterValues.name" clearable @update:modelValue="inputHit" />
					<TextInput class="grow" :label="txt('From')" type="date" v-model="filterValues.from" @change="applyFilter" :max="todayDate" />
					<TextInput class="grow" :label="txt('To')" type="date" v-model="filterValues.to" @change="applyFilter" :max="todayDate" />
					<SelectInput :label="txt('Changed by')" class="grow" :options="userListOptions" allowEmpty v-model="filterValues.by" @update:modelValue="applyFilter" />
				</InputsRow>
			</SlideToggle>
			<FilterTags>
				<Tag v-if="filterValues.name" @click="() => { filterValues.name = ''; applyFilter() }" clearable>{{ txt('Item') }}: {{ filterValues.name }}</Tag>
				<Tag v-if="filterValues.from" @click="() => { filterValues.from = ''; applyFilter() }" clearable>{{ txt('From') }}: {{ filterValues.from }}</Tag>
				<Tag v-if="filterValues.to" @click="() => { filterValues.to = ''; applyFilter() }" clearable>{{ txt('To') }}: {{ filterValues.to }}</Tag>
				<Tag v-if="filterValues.by" @click="() => { filterValues.by = ''; applyFilter() }" clearable>{{ txt('Changed by') }}: {{ usersMap[filterValues.by] }}</Tag>
			</FilterTags>
			<Loader class="line" :loading="isLoading">
				<DataTable :items="changes.data">
					<template v-if="Object.values(filterValues).some(f => f)" #empty>
						<Button icon="x" variant="outline" @click="clearFilter">Reset filter</Button>
					</template>
					<Column :header="txt('Item')" :colClick="(data) => router.visit(`/warehouse/${data.warehouse_item.id}`)" minWidth="7rem">
						<template #default="{ data }"><span class="basic-link">{{ data.warehouse_item.name }}</span></template>
					</Column>
					<Column :header="txt('Note')" field="note" />
					<Column :header="txt('Change')" align="center">
						<template #default="{ data }">{{ data.change > 0 ? `+${data.change.toLocaleString('SK')}` : data.change.toLocaleString('SK') }} {{ data.warehouse_item.unit }}</template>
					</Column>
					<Column :header="txt('Datetime')" field="created_at" type="date" />
					<Column :header="txt('Changed by')" align="center">
						<template #default="{ data }">{{ data.author?.name ?? '-' }}</template>
					</Column>
				</DataTable>
			</Loader>
			<Pagination
				v-if="changes.links"
				:currentPage="changes.current_page"
				:links="changes.links"
				:prevPage="changes.prev_page_url"
				:nextPage="changes.next_page_url"
				:firstPage="changes.first_page_url"
				:lastPage="changes.last_page_url"
				:pages="changes.last_page"
				:from="changes.from"
				:to="changes.to"
				:total="changes.total"
			/>
		</Card>
	</AuthenticatedLayout>
</template>