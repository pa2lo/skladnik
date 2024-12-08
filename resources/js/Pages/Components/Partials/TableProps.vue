<script setup>
import { toast } from '@/Utils/toaster'

const props = defineProps({
	properties: Array,
	hideDefaults: Boolean,
	header: String
})

const hasType = props.properties.some(p => p.type)
const hasParameters = props.properties.some(p => p.parameters)
const hasScope = props.properties.some(p => p.scope)

async function copy(val) {
	await navigator.clipboard.writeText(val).then(() => {
		toast.success('Copied to clipboard')
	})
}
</script>

<template>
	<h3 v-if="header">{{ header }}</h3>
	<div class="dataTable-wrapper line">
		<table class="infoTable">
			<thead>
				<tr>
					<th>Name</th>
					<th v-if="hasType">Type</th>
					<th v-if="hasScope">Scope</th>
					<th v-if="hasParameters">Parameters</th>
					<th v-if="!hideDefaults">Default</th>
					<th>Note</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="row in properties">
					<td class="infoTable-copy" @click="copy(row?.name)"><strong>{{ row?.name }}</strong></td>
					<td class="infoTable-type" v-if="hasType">{{ row?.type }}</td>
					<td v-if="hasScope">{{ row?.scope }}</td>
					<td class="infoTable-type" v-if="hasParameters">{{ row?.parameters }}</td>
					<td v-if="!hideDefaults">{{ row?.default ?? '-' }}</td>
					<td v-html="row.note || ''"></td>
				</tr>
			</tbody>
		</table>
	</div>
</template>