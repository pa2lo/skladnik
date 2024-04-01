<script setup>
import { ref } from 'vue'

import { toast } from '@/Utils/toaster'
import { dialog } from '@/Utils/dialog'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import Modal from '@/Components/Modals/Modal.vue'
import Button from '@/Components/Elements/Button.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'
import TableProps from './Partials/TableProps.vue'
import Accordion from '@/Components/Elements/Accordion.vue'

import Message from '@/Components/Elements/Message.vue'

const modalTest1 = ref(false)
const modalTest2 = ref(false)

const dialogConfirm = () => {
	dialog.confirm('Confirm dialog', 'Message of confirm dialog window', {
		onCancel: () => {
			toast.info('Confirm dialog cancelled')
		},
		onConfirm: () => {
			toast.success('Confirm dialog confirmed')
		}
	})
}
const dialogDelete = () => {
	dialog.delete('Delete dialog', 'Message of delete dialog window', {
		onCancel: () => {
			toast.info('Delete dialog cancelled')
		},
		onConfirm: () => {
			toast.success('Delete dialog confirmed')
		}
	})
}

const dialogInfo = () => dialog.info('Dialog info')
const dialogSuccess = () => dialog.success('Dialog success')
const dialogWarning = () => dialog.warning('Dialog warning')
const dialogError = () => dialog.error('Dialog error')
const dialogImage = () => dialog.image('/img/example.jpg', 'example.jpg')

function errorToast() {
	toast.error('Error toast w click', {
		onClick: () => dialog.warning('alert')
	})
}

const showModalInfo = ref(false)
const modalExampleCode = `const modalOpen = ref(false)

<Modal v-model:open="modalOpen" header="Modal header" headerNote="Modal header note">
 <p>Modal body</p>
 <template #footer>
  Modal footer
 </template>
 <template #buttons>
  <Button variant="outline">Button 1</Button>
  <Button>Button 2</Button>
 </template>
</Modal>`
const modalProps = [
	{
		name: 'header',
		type: 'String'
	}, {
		name: 'headerNote',
		type: 'String'
	}, {
		name: 'as',
		type: 'String',
		note: 'optional: <i>form</i> for example if you want to use Card as form'
	}, {
		name: 'width',
		type: 'String',
		default: 'normal',
		note: 'available: narrow | narrower | normal | wider | wide | full'
	}, {
		name: 'open',
		type: 'Boolean',
		note: 'model for opening modal'
	}, {
		name: 'closeable',
		type: 'Boolean',
		default: true
	}, {
		name: 'showCloseButton',
		type: 'Boolean',
		default: false
	}, {
		name: 'closeButtonText',
		type: 'String',
		default: 'Close'
	}
]
const modalSlots = [
	{
		name: 'header',
		default: 'header and headerNote prop'
	}, {
		name: 'default',
		note: 'body'
	}, {
		name: 'footer'
	}, {
		name: 'buttons'
	}
]
const modalEvents = [
	{
		name: 'modalOpen'
	}, {
		name: 'modalClosed'
	}
]

const showDialogInfo = ref(false)
const dialogCodeExample = `import { dialog } from '@/Utils/dialog'

// functions
dialog.confirm(title, message, options)
dialog.delete(title, message, options)
dialog.info(title, message, options)
dialog.success(title, message, options)
dialog.warning(title, message, options)
dialog.error(title, message, options)
dialog.image(image, title)

// example
dialog.delete('Delete dialog', 'Message of delete dialog window', {
 onCancel: () => toast.info('Delete dialog cancelled'),
 onConfirm: () => toast.success('Delete dialog confirmed')
})`
const dialogOptions = [
	{
		name: 'closeable',
		type: 'Boolean',
		default: true,
		note: 'false in confirm and delete dialog'
	}, {
		name: 'width',
		type: 'String',
		default: 'narrow',
		note: 'available: narrow | narrower | normal | wider | wide | full'
	}, {
		name: 'onCancel',
		type: 'Function'
	}, {
		name: 'showCancel',
		type: 'Boolean',
		default: false,
		note: 'true in confirm and delete dialog'
	}, {
		name: 'cancelColor',
		type: 'String',
		default: 'link'
	}, {
		name: 'cancelText',
		type: 'String',
		default: 'Cancel'
	}, {
		name: 'onConfirm',
		type: 'Function'
	}, {
		name: 'confirmColor',
		type: 'String',
		default: 'primary',
		note: 'danger in delete dialog'
	}, {
		name: 'confirmText',
		type: 'String',
		default: 'Ok',
		note: 'Yes in confirm dialog, Delete in delete dialog'
	}, {
		name: 'image',
		type: 'String',
		note: 'image URL for image preview'
	}
]

const showToastInfo = ref(false)
const toastCodeExample = `import { toast } from '@/Utils/toaster'

// functions
toast.info(title, options)
toast.success(title, options)
toast.warning(title, options)
toast.error(title, options)

// example
toast.error('Infinite error toast w click', {
 timeout: 0,
 onClick: () => dialog.warning('alert')
})`
const toastOptions = [
	{
		name: 'message',
		type: 'String'
	}, {
		name: 'timeout',
		type: 'Number',
		default: 7000,
		note: '0 for infinite'
	}, {
		name: 'onClick',
		type: 'Function'
	}
]

const showMessageInfo = ref(false)
const messageCodeExample = `<Message type="success">
 <p>Success message w button</p>
 <template #buttons>
  <Button iconRight="right" size="compact">Button</Button>
 </template>
</Message>`
const messageProps = [
	{
		name: 'type',
		type: 'String',
		default: 'info',
		note: 'available: info | success | warning | error'
	}, {
		name: 'solid',
		type: 'Boolean',
		default: false
	}, {
		name: 'dismissible',
		type: 'Boolean',
		default: false
	}
]
const messageSlots = [
	{
		name: 'default',
		note: 'message text'
	}, {
		name: 'buttons'
	}
]
const messageEvents = [
	{
		name: 'dismissed'
	}
]
</script>

<template>
	<AuthenticatedLayout header="Modals, toasts, alerts">
		<Card header="Modal">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showModalInfo = true" />
			</template>
			<p class="buttons-row">
				<Button @click.prevent="modalTest1 = true">Modal normal</Button>
				<Button @click.prevent="modalTest2 = true">Modal narrow</Button>
			</p>
			<Modal v-model:open="modalTest1" header="Modal header" headerNote="Modal header note">
				<p>Modal body</p>
				<template #footer>
					Modal footer
				</template>
				<template #buttons>
					<Button variant="outline">Button 1</Button>
					<Button>Button 2</Button>
				</template>
			</Modal>
			<Modal v-model:open="modalTest2" width="narrow" header="Modal narrow">
				<p>Modal body</p>
				<template #footer>
					Modal footer
				</template>
				<template #buttons>
					<Button variant="outline">Button 1</Button>
					<Button>Button 2</Button>
				</template>
			</Modal>
			<Modal v-model:open="showModalInfo" header="Modal component">
				<div>
					<Accordion title="Code example" pre>
						{{ modalExampleCode }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="modalProps" />
				<TableProps header="Slots" :properties="modalSlots" />
				<TableProps header="Events" :properties="modalEvents" hideDefaults />
			</Modal>
		</Card>
		<Card header="Dialogs">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showDialogInfo = true" />
			</template>
			<p class="buttons-row">
				<Button @click.prevent="dialogConfirm">Confirm dialog</Button>
				<Button @click.prevent="dialogDelete">Delete dialog</Button>
				<Button @click.prevent="dialogInfo">Info</Button>
				<Button @click.prevent="dialogSuccess">Success</Button>
				<Button @click.prevent="dialogWarning">Warning</Button>
				<Button @click.prevent="dialogError">Error</Button>
				<Button @click.prevent="dialogImage">Image</Button>
			</p>
			<Modal v-model:open="showDialogInfo" header="Dialog function">
				<div>
					<Accordion title="Code example" pre>
						{{ dialogCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Options" :properties="dialogOptions" />
			</Modal>
		</Card>
		<Card header="Toasts">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showToastInfo = true" />
			</template>
			<p class="buttons-row">
				<Button @click.prevent="() => toast.info('Info toast')">Info toast</Button>
				<Button @click.prevent="() => toast.success('Success toast infinite', { timeout: 0 })">Success toast infinite</Button>
				<Button @click.prevent="() => toast.warning('Warning toast w note', { message: 'Toast message toast message toast message toast message' })">Warning toast w note</Button>
				<Button @click.prevent="errorToast">Error toast w click</Button>
			</p>
			<Modal v-model:open="showToastInfo" header="Toast function">
				<div>
					<Accordion title="Code example" pre>
						{{ toastCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Options" :properties="toastOptions" />
			</Modal>
		</Card>
		<Card header="Messages">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showMessageInfo = true" />
			</template>
			<Message>Info message</Message>
			<Message type="success" dismissible @dismissed="console.log('dismissed')">Success message dismissible</Message>
			<Message type="warning">Warning message</Message>
			<Message type="error" dismissible>Error message dismissible</Message>
			<Message>
				<p>Info message w button</p>
				<template #buttons>
					<Button iconRight="right" size="compact">Button</Button>
				</template>
			</Message>
			<Message solid dismissible>Info message solid dismissible</Message>
			<Message type="success" solid>Success message solid</Message>
			<Message type="warning" solid dismissible>Warning message solid dismissible</Message>
			<Message type="error" solid>Error message solid</Message>
			<Modal v-model:open="showMessageInfo" header="Message component">
				<div>
					<Accordion title="Code example" pre>
						{{ messageCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="messageProps" />
				<TableProps header="Slots" :properties="messageSlots" />
				<TableProps header="Events" :properties="messageEvents" hideDefaults />
			</Modal>
		</Card>
	</AuthenticatedLayout>
</template>