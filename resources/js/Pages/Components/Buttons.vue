<script setup>
import { ref } from 'vue'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import Modal from '@/Components/Modals/Modal.vue'
import Button from '@/Components/Elements/Button.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'
import IcoButtonCopy from '@/Components/Elements/IcoButtonCopy.vue'
import TableProps from './Partials/TableProps.vue'
import Accordion from '@/Components/Elements/Accordion.vue'

import ButtonsGroup from '@/Components/Elements/ButtonsGroup.vue'

const showButtonInfo = ref(false)
const showIcoButtonInfo = ref(false)
const showIcoButtonCopyInfo = ref(false)
const buttonCodeExample = `<Button>Primary</Button>
<Button color="secondary" variant="outline">Secondary</Button>
<Button icon="logout" color="link" full>Logout</Button>

<ButtonsGroup align="left">
 <Button variant="outline">Button 1 </Button>
 <Button icon="logout" variant="outline">Button 2 </Button>
 <Button icon="down" variant="outline"></Button>
</ButtonsGroup>`
const icoButtonCodeExample = `<IcoButton icon="x" v-tooltip="'default'" />
<IcoButton icon="x" transparent v-tooltip="'transparent'" />
<IcoButton icon="x" color="warning" variant="solid" v-tooltip="'warning solid'" />`
const icoButtonCopyCodeExample = `<IcoButtonCopy copyableText="Text to copy" />`
const icoButtonProps = [
	{
		name: 'icon',
		type: 'String'
	}, {
		name: 'link',
		type: 'String'
	}, {
		name: 'linkParam',
		type: '[String, Number]',
		note: 'link parameter'
	}, {
		name: 'color',
		type: 'String',
		default: 'heading',
		note: 'available: primary | secondary | heading | info | success | warning | danger | link'
	}, {
		name: 'variant',
		type: 'String',
		default: 'plain',
		note: 'available: solid | outline | plain'
	}, {
		name: 'type',
		type: 'String',
		default: 'button'
	}, {
		name: 'disabled',
		type: 'Boolean',
		default: false
	}, {
		name: 'loading',
		type: 'Boolean',
		default: false
	}, {
		name: 'highlighted',
		type: 'Boolean',
		default: false
	}, {
		name: 'invisible',
		type: 'Boolean',
		default: false,
		note: 'invisible without pointer events'
	}, {
		name: 'transparent',
		type: 'Boolean',
		default: false,
		note: 'semitransparent button when not hovered'
	}, {
		name: 'download',
		type: 'Boolean',
		default: false
	}
]
const icoButtonCopyProps = [...icoButtonProps.filter(i => ['color', 'variant', 'disabled', 'highlighted', 'invisible', 'transparent'].includes(i.name)), {
	name: 'copyableText',
	type: 'String',
	note: 'text to copy on click'
}]
const buttonProps = [
	{
		name: 'label',
		type: 'String'
	}, {
		name: 'icon',
		type: 'String'
	}, {
		name: 'iconRight',
		type: 'String'
	}, {
		name: 'link',
		type: 'String'
	}, {
		name: 'linkParam',
		type: '[String, Number]',
		note: 'link parameter'
	}, {
		name: 'color',
		type: 'String',
		default: 'primary',
		note: 'available: primary | secondary | heading | info | success | warning | danger | link'
	}, {
		name: 'variant',
		type: 'String',
		default: 'solid',
		note: 'available: solid | outline | plain'
	}, {
		name: 'size',
		type: 'String',
		default: 'normal',
		note: 'available: compact | normal | bigger'
	}, {
		name: 'type',
		type: 'String',
		default: 'button'
	}, {
		name: 'disabled',
		type: 'Boolean',
		default: false
	}, {
		name: 'loading',
		type: 'Boolean',
		default: false
	}, {
		name: 'bigIcon',
		type: 'Boolean',
		default: false
	}, {
		name: 'full',
		type: 'Boolean',
		default: false
	}, {
		name: 'download',
		type: 'Boolean',
		default: false
	}
]
const buttonSlots = [
	{
		name: 'default',
		default: 'label prop',
		note: 'Button text'
	}
]
const buttonsGroupProps = [
	{
		name: 'align',
		type: 'String',
		default: 'left',
		note: 'available: left | center | right'
	}, {
		name: 'full',
		type: 'Boolean',
		default: false
	}
]
</script>

<template>
	<AuthenticatedLayout header="Buttons">
		<Card header="Buttons">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showButtonInfo = true" />
			</template>
			<h4>Colors</h4>
			<p class="buttons-row">
				<Button>Primary</Button>
				<Button color="secondary">Secondary</Button>
				<Button color="heading">Heading</Button>
				<Button color="info">Info</Button>
				<Button color="success">Success</Button>
				<Button color="warning">Warning</Button>
				<Button color="danger">Danger</Button>
				<Button color="link">Link</Button>
			</p>
			<h4>Variations</h4>
			<p class="buttons-row">
				<Button variant="solid">Solid</Button>
				<Button variant="outline">Outline</Button>
				<Button variant="plain">Plain</Button>
			</p>
			<h4>Sizes</h4>
			<p class="buttons-row">
				<Button size="compact">Compact</Button>
				<Button size="normal">Normal</Button>
				<Button size="bigger">Bigger</Button>
			</p>
			<h4>States</h4>
			<p class="buttons-row">
				<Button disabled title="disabled">Disabled</Button>
				<Button loading title="loading">Loading</Button>
			</p>
			<h4>Icons</h4>
			<p class="buttons-row">
				<Button icon="logout">Icon</Button>
				<Button icon-right="logout">Icon right</Button>
				<Button icon="logout" size="compact">Compact</Button>
				<Button icon="logout" bigIcon>bigIcon</Button>
				<Button icon="logout" size="compact" bigIcon>bigIcon</Button>
				<Button icon="logout" title="iconOnly"></Button>
				<Button icon="logout" bigIcon title="iconOnly bigIcon"></Button>
				<Button icon="logout" size="compact" title="iconOnly compact"></Button>
				<Button icon="logout" size="compact" bigIcon title="compact bigIcon"></Button>
			</p>
			<h4>Full</h4>
			<p class="buttons-row">
				<Button icon="logout" full>Logout full</Button>
			</p>
			<h4 class="divided">Buttons group</h4>
			<ButtonsGroup>
				<Button variant="outline">Button 1 </Button>
				<Button icon="logout" variant="outline">Button 2 </Button>
				<Button icon="down" variant="outline"></Button>
			</ButtonsGroup>
			<Modal v-model:open="showButtonInfo" header="Button component">
				<div>
					<Accordion title="Code example" pre>
						{{ buttonCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props - Button" :properties="buttonProps" />
				<TableProps header="Slots - Button" :properties="buttonSlots" />
				<TableProps header="Props - ButtonsGroup" :properties="buttonsGroupProps" />
			</Modal>
		</Card>
		<Card header="IcoButton">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showIcoButtonInfo = true" />
			</template>
			<p class="buttons-row">
				<IcoButton icon="x" v-tooltip="'default'" />
				<IcoButton color="danger" loading icon="x" v-tooltip="'danger loading'" />
				<IcoButton color="success" disabled icon="x" v-tooltip="'success disabled'" />
				<IcoButton color="primary" icon="x" v-tooltip="'primary'" />
				<IcoButton color="secondary" icon="x" v-tooltip="'secondary'" />
				<IcoButton color="link" icon="x" v-tooltip="'link'" />
				<IcoButton highlighted icon="x" v-tooltip="'highlighted'" />
				<IcoButton transparent icon="x" v-tooltip="'transparent'" />
				<IcoButton color="warning" variant="solid" icon="x" v-tooltip="'warning solid'" />
				<IcoButton variant="outline" icon="x" v-tooltip="'outline'" />
				<IcoButton circle icon="x" v-tooltip="'circle'" />
			</p>
			<Modal v-model:open="showIcoButtonInfo" header="IcoButton component">
				<div>
					<Accordion title="Code example" pre>
						{{ icoButtonCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="icoButtonProps" />
			</Modal>
		</Card>
		<Card header="IcoButtonCopy">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showIcoButtonCopyInfo = true" />
			</template>
			<p class="buttons-row">
				<IcoButtonCopy copyableText="Text to copy" />
				<IcoButtonCopy variant="solid" color="primary" copyableText="Text to copy" />
			</p>
			<Modal v-model:open="showIcoButtonCopyInfo" header="IcoButtonCopy component">
				<div>
					<Accordion title="Code example" pre>
						{{ icoButtonCopyCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="icoButtonCopyProps" />
			</Modal>
		</Card>
	</AuthenticatedLayout>
</template>