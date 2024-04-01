<script setup>
defineProps({
	columns: Array
})

function getAlignClass(col) {
	if (col.props?.type == 'date' && !col.props.align) return 'ta-c'

	if (col.props?.align) return {
		left: 'ta-l',
		center: 'ta-c',
		right: 'ta-r'
	}[col.props.align]
}
</script>

<template>
	<thead>
		<tr class="dataTable-header-row">
			<th
				v-for="col in columns"
				class="dataTable-th"
				:class="[
					getAlignClass(col),
					{
						isEmpty: !col.props?.header,
					}
				]"
				:style="{'--min-width': col.props?.minWidth}"
			>
				<template v-if="col.props?.header">
					{{ col.props.header }}
				</template>
			</th>
		</tr>
	</thead>
</template>