<script setup>
import { ref } from 'vue'

import { dialog } from '@/Utils/dialog'
import { toast } from '@/Utils/toaster'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import Modal from '@/Components/Modals/Modal.vue'
import Button from '@/Components/Elements/Button.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'
import TableProps from './Partials/TableProps.vue'
import Accordion from '@/Components/Elements/Accordion.vue'

import Tooltip from '@/Components/Floating/Tooltip.vue'
import Icon from '@/Components/Elements/Icon.vue'
import SlideToggle from '@/Components/Elements/SlideToggle.vue'
import Tag from '@/Components/Elements/Tag.vue'
import ButtonsGroup from '@/Components/Elements/ButtonsGroup.vue'
import Dropdown from '@/Components/Floating/Dropdown.vue'
import DropdownLink from '@/Components/Floating/DropdownLink.vue'
import Loader from '@/Components/Elements/Loader.vue'

const toolTip1 = ref(true)

const accordionData = {
	'Key': 'Value',
	'Key2': 'Value2',
}

const iconsArr = ['x', 'menu', 'user-edit', 'dashboard', 'info2', 'moon', 'sun', 'logout', 'eye', 'eye-off', 'copy', 'check', 'circle-check', 'circle-x', 'circle-info', 'circle-alert', 'circle-question', 'right', 'double-right', 'left', 'double-left', 'down', 'up', 'back', 'edit', 'trash', 'circle-check-animated', 'circle-info-animated', 'circle-alert-animated', 'circle-x-animated', 'circle-question-animated', 'plus', 'minus', 'archive', 'external-link', 'mail', 'stack', 'history', 'plusminus', 'users', 'save', 'print', 'download', 'github', 'components', 'boxes', 'code', 'search', 'dots', 'calendar', 'filter', 'clock', 'refresh', 'article', 'settings', 'folder-open']

async function copy(val) {
	await navigator.clipboard.writeText(val).then(() => {
		toast.success('Copied to clipboard')
	})
}

const isToggled = ref(false)

const showTooltipInfo = ref(false)
const tooltipCodeExample = `const tooltipOptions = {
 text: 'Tooltip text Tooltip text Tooltip text Tooltip text Tooltip text',
 hoverable: true,
 touch: true,
 width: 'narrow'
}

<Button v-tooltip="'Tooltip text'">Hover me</Button>
<Button v-tooltip="tooltipOptions" class="ml-a">Tooltip hoverable touch object</Button>

<Tooltip tooltip="Tooltip text">
 <Button>Hover me</Button>
</Tooltip>
<Tooltip hoverable touch>
 <Button>Hover me</Button>
 <template #tooltip>
  <p>Tooltip slot</p>
 </template>
</Tooltip>`
const tooltipProps = [
	{
		name: 'tooltip',
		type: 'String'
	}, {
		name: 'hoverable',
		type: 'Boolean',
		default: false
	}, {
		name: 'touch',
		type: 'Boolean',
		default: false
	}, {
		name: 'width',
		type: 'String',
		default: 'normal',
		note: 'available: narrow | normal | wide'
	}
]
const tooltipSlots = [
	{
		name: 'default',
		note: 'tooltip trigger'
	}, {
		name: 'tooltip',
		default: 'tooltip prop',
		note: 'tooltip content'
	}
]
const tooltipModifiers = [
	{
		name: 'hoverable',
		note: 'tooltip content hoverable'
	}, {
		name: 'touch',
		note: 'show tooltip on touch'
	}
]
const tooltipOptions = [
	{
		name: 'text',
		type: 'String'
	}, {
		name: 'hoverable',
		type: 'Boolean',
		default: false
	}, {
		name: 'touch',
		type: 'Boolean',
		default: false
	}, {
		name: 'width',
		type: 'String',
		default: 'normal',
		note: 'available: narrow | normal | wide'
	}
]

const showIconInfo = ref(false)
const iconCodeExample = `<Icon name="x" />
<Icon name="circle-alert" />`
const iconProps = [
	{
		name: 'name',
		type: 'String'
	}
]

const showSlideToggleInfo = ref(false)
const slideToggleCodeExample = `const show = ref(false)

<Button @click="show = !show">Toggle content</Button>
<SlideToggle :show="show">
 <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos quod recusandae architecto nulla quaerat fugit.</p>
</SlideToggle>`
const slideToggleProps = [
	{
		name: 'show',
		type: 'Boolean',
		default: false
	}
]
const slideToggleSlots = [
	{
		name: 'default',
		note: 'content'
	}
]

const textClasses = [
	{
		name: 'likeH1',
		note: 'font size like H1'
	}, {
		name: 'likeH2',
		note: 'font size like H2'
	}, {
		name: 'likeH3',
		note: 'font size like H3'
	}, {
		name: 'likeH4',
		note: 'font size like H4'
	}, {
		name: 'likeH5',
		note: 'font size like H5'
	}, {
		name: 'smaller',
		note: 'smaller font size'
	}, {
		name: 'nowrap',
		note: 'nowrap text'
	}, {
		name: 'lh-1',
		note: 'line height 1'
	}, {
		name: 'ta-l',
		note: 'text-align left'
	}, {
		name: 'ta-c',
		note: 'text-align center'
	}, {
		name: 'ta-r',
		note: 'text-align right'
	}, {
		name: 'color-error',
		note: 'error color'
	}, {
		name: 'color-link',
		note: 'link color'
	}, {
		name: 'color-info',
		note: 'info color'
	}, {
		name: 'color-danger',
		note: 'danger color'
	}, {
		name: 'color-success',
		note: 'success color'
	}, {
		name: 'color-warn',
		note: 'warning color'
	}, {
		name: 'color-heading',
		note: 'heading color'
	}, {
		name: 'text-light',
		note: 'text with opacity'
	}, {
		name: 'basic-link',
		note: 'show as basic underlined link'
	}, {
		name: 'nu-link',
		note: 'not underlined link'
	}
]
const spacingClasses = [
	{
		name: 'line',
		note: 'row margin'
	}, {
		name: 'margin-bigger',
		note: 'bigger margin'
	}, {
		name: 'section',
		note: 'big margin'
	}, {
		name: 'ml-a',
		note: 'margin left auto'
	}, {
		name: 'mi-a',
		note: 'margin inline auto'
	}, {
		name: 'mr-a',
		note: 'margin right auto'
	}, {
		name: 'mb-a',
		note: 'margin bottom auto'
	}, {
		name: 'm0',
		note: 'margin 0'
	}, {
		name: 'mt07',
		note: 'margin top .75rem'
	}, {
		name: 'mt06',
		note: 'margin top .625rem'
	}, {
		name: 'mt05',
		note: 'margin top .5rem'
	}, {
		name: 'mt03',
		note: 'margin top .375rem'
	}, {
		name: 'mt01',
		note: 'margin top .1875rem'
	}
]
const utilityClasses = [
	{
		name: 'flex',
		note: 'flex container'
	}, {
		name: 'ai-c',
		note: 'align items to center in flex'
	}, {
		name: 'aj-c',
		note: 'align and justify to center in flex'
	}, {
		name: 'as-c',
		note: 'align self center in flex'
	}, {
		name: 'as-e',
		note: 'align self end in flex'
	}, {
		name: 'grow',
		note: 'grow and shrink in flex (1 1 auto)'
	}, {
		name: 'divided',
		note: 'divided line'
	}, {
		name: 'clickable',
		note: 'pointer cursor and reset tap highlight'
	}, {
		name: 'buttons-row',
		note: 'flex wrapper with spaces for buttons...'
	}, {
		name: 'tags-row',
		note: 'flex wrapper with spaces for tags...'
	}, {
		name: 'inputs-grid',
		note: 'grid wrapper for inputs'
	}, {
		name: 'cols3',
		note: 'smaller cols for inputs-grid'
	}, {
		name: 'input-col1',
		note: 'force col1 in inputs-grid'
	}, {
		name: 'input-full',
		note: 'full width in inputs-grid'
	}, {
		name: 'sr-only',
		note: 'screen readers only'
	}, {
		name: 'l-hide',
		note: 'hide above 60rem'
	}, {
		name: 'rl-hide',
		note: 'hide below 60rem'
	}, {
		name: 'rm-hide',
		note: 'hide below 35rem'
	}
]

const showAccordionInfo = ref(null)
const accordionCodeExample = `const accordionData = {
 'Key': 'Value',
 'Key2': 'Value2',
}

<Accordion title="Accordion 1" open>
 <p>Accordion content</p>
</Accordion>
<Accordion title="Accordion 2">
 <template #trigger>
  Custom trigger
 </template>
 <p>Accordion content</p>
</Accordion>
<Accordion title="Accordion 2 pre" pre>
 {{ accordionData }}
</Accordion>`
const accordionProps = [
	{
		name: 'title',
		type: 'String'
	}, {
		name: 'open',
		type: 'Boolean',
		default: false,
		note: 'open by default'
	}, {
		name: 'pre',
		type: 'Boolean',
		default: false,
		note: 'show preformatted content'
	}
]
const accordionSlots = [
	{
		name: 'default',
		note: 'accordion content'
	}, {
		name: 'trigger',
		default: 'title prop',
		note: 'accordion trigger'
	}
]

const showTagInfo = ref(false)
const tagCodeExample = `<div class="tags-row">
 <Tag>Text</Tag>
 <Tag color="secondary" solid>Secondary</Tag>
</div>`
const tagProps = [
	{
		name: 'icon',
		type: 'String'
	}, {
		name: 'color',
		type: 'String',
		default: 'heading',
		note: 'available: primary | secondary | heading | info | success | warning | danger | link<br>defaults to link if clearable'
	}, {
		name: 'solid',
		type: 'Boolean',
		default: false
	}, {
		name: 'clearable',
		type: 'Boolean',
		default: false,
		note: 'add pointer cursor and X icon'
	}
]

const dropdownOption = ref(1)
function setDropdownOption(num) {
	dropdownOption.value = num
}

const isLoading = ref(true)
const loadingText = ref(true)
const showLoaderInfo = ref(false)
const loaderCodeExample = `const isLoading = ref(false)

<Loader :loading="isLoading">
 <p>Loader inner content...</p>
</Loader>`
const loaderProps = [
	{
		name: 'loading',
		type: 'Boolean',
		default: false
	}, {
		name: 'text',
		type: 'String'
	}
]

const showDropdownInfo = ref(false)
const dropdownCodeExample = `<Dropdown label="Dropdown">
 <DropdownLink icon="boxes" label="Dashboard" link="dashboard" />
 <DropdownLink icon="users" label="Users" link="/users" />
 <DropdownLink label="Dialog" @click="dialog.info('ok')" color="error" />
 <hr>
 <DropdownLink closeable label="Option 1" :checked="dropdownOption == 1" @click="setDropdownOption(1)" />
 <DropdownLink disabled label="Option 2" :checked="dropdownOption == 2" @click="setDropdownOption(2)" />
 <hr>
 <p>Some text content</p>
</Dropdown>`
const dropdownProps = [
	{
		name: 'element',
		type: 'String',
		default: 'button',
		note: 'available: button | icon'
	}, {
		name: 'icon',
		type: 'String',
		default: 'down'
	}, {
		name: 'togglerIcon',
		type: 'String',
		note: 'left icon for button'
	}, {
		name: 'align',
		type: 'String',
		default: 'left',
		note: 'available: left | right'
	}, {
		name: 'closeOnClick',
		type: 'Boolean',
		default: false,
		note: 'immediate close on first click'
	}, {
		name: 'focusFirst',
		type: 'Boolean',
		default: false
	}, {
		name: 'disabled',
		type: 'Boolean',
		default: false
	}
]
const dropdownSlots = [
	{
		name: 'toggler',
		default: 'button',
		note: 'custom dropdown toggler'
	}, {
		name: 'default',
		note: 'dropdown content'
	}
]
const dropdownLinkProps = [
	{
		name: 'label',
		type: 'String'
	}, {
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
		name: 'disabled',
		type: 'Boolean',
		default: false
	}, {
		name: 'checked',
		type: 'Boolean',
		default: false
	}, {
		name: 'closeable',
		type: 'Boolean',
		default: false,
		note: 'close dropdown on click'
	}, {
		name: 'color',
		type: 'String',
		default: 'heading',
		note: 'available: primary | secondary | success | warning | danger | info | error'
	}
]
const dropdownLinkSlots = [
	{
		name: 'default',
		default: 'label prop',
		note: 'dropdown link text'
	}
]
</script>

<template>
	<AuthenticatedLayout header="Tooltips, other">
		<Card header="Tooltip">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showTooltipInfo = true" />
			</template>
			<h4>Component</h4>
			<div class="line flex ai-c">
				<Tooltip :tooltip="toolTip1 ? 'Tooltip 1' : 'Second tooltip with longer text'">
					<Button @click.prevent="toolTip1 = !toolTip1">Tooltip</Button>
				</Tooltip>
				<Tooltip class="ml-a" hoverable touch>
					<Button>Tooltip hoverable touch</Button>
					<template #tooltip>
						<p>Complex tooltip in slot</p>
						<p><Button size="compact">Button</Button></p>
					</template>
				</Tooltip>
			</div>
			<h4>Directive</h4>
			<div class="line flex ai-c">
				<Button v-tooltip="toolTip1 ? 'Tooltip 1' : 'Second tooltip with longer text'" @click.prevent="toolTip1 = !toolTip1">Tooltip</Button>
				<Button v-tooltip.touch="'Tooltip text Tooltip text Tooltip text Tooltip text Tooltip text'" class="ml-a">Tooltip touch</Button>
				<Button v-tooltip="{
					text: 'Tooltip text Tooltip text Tooltip text Tooltip text Tooltip text',
					hoverable: true,
					touch: true
				}" class="ml-a">Tooltip hoverable touch object</Button>
			</div>
			<Modal v-model:open="showTooltipInfo" header="Tooltips">
				<div>
					<Accordion title="Code example" pre>
						{{ tooltipCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props - Tooltip component" :properties="tooltipProps" />
				<TableProps header="Slots - Tooltip component" :properties="tooltipSlots" />
				<TableProps header="Directive modifiers" :properties="tooltipModifiers" hideDefaults />
				<TableProps header="Directive options" :properties="tooltipOptions" />
			</Modal>
		</Card>
		<Card header="Icon" headerNote="Click to copy">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showIconInfo = true" />
			</template>
			<p class="icons color-heading">
				<Icon v-for="ico in iconsArr" :name="ico" v-tooltip="ico" @click.prevent="copy(ico)" />
			</p>
			<Modal v-model:open="showIconInfo" header="Icon component">
				<div>
					<Accordion title="Code example" pre>
						{{ iconCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="iconProps" />
			</Modal>
		</Card>
		<Card header="SlideToggle">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showSlideToggleInfo = true" />
			</template>
			<p><Button @click.prevent="isToggled = !isToggled">Toggle {{ isToggled ? 'hidden' : 'visible' }}</Button></p>
			<SlideToggle :show="isToggled" class="line">
				<div class="slideExample">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos quod recusandae architecto nulla quaerat fugit.
				</div>
			</SlideToggle>
			<Modal v-model:open="showSlideToggleInfo" header="SlideToggle component">
				<div>
					<Accordion title="Code example" pre>
						{{ slideToggleCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="slideToggleProps" />
				<TableProps header="Slots" :properties="slideToggleSlots" />
			</Modal>
		</Card>
		<Card header="Accordion">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showAccordionInfo = true" />
			</template>
			<Accordion title="Accordion 1" open>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magnam modi qui, aspernatur ut aut!
			</Accordion>
			<Accordion title="Accordion 2">
				<template #trigger>
					Custom trigger
				</template>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo magnam modi qui, aspernatur ut aut!
			</Accordion>
			<Accordion title="Accordion 3 pre" pre>
				{{ accordionData }}
			</Accordion>
			<Modal v-model:open="showAccordionInfo" header="Accordion component">
				<div>
					<Accordion title="Code example" pre>
						{{ accordionCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="accordionProps" />
				<TableProps header="Slots" :properties="accordionSlots" />
			</Modal>
		</Card>
		<Card header="Dropdown">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showDropdownInfo = true" />
			</template>
			<div class="buttons-row">
				<Dropdown label="Dropdown">
					<DropdownLink icon="users" label="link 1" link="/" />
					<DropdownLink disabled label="Disabled" link="/dashboard" />
					<DropdownLink icon="boxes" label="link 2" link="dashboard" color="error" />
					<DropdownLink label="link 3 - w onclick" @click="dialog.info('ok')" />
					<hr>
					<DropdownLink closeable label="Option 1" :checked="dropdownOption == 1" @click="setDropdownOption(1)" />
					<DropdownLink closeable label="Option 2" :checked="dropdownOption == 2" @click="setDropdownOption(2)" />
					<DropdownLink closeable label="Option 3" :checked="dropdownOption == 3" @click="setDropdownOption(3)" />
					<hr>
					<p>Some text content</p>
					<hr>
					<DropdownLink label="link 4" link="dashboard" />
				</Dropdown>
				<Dropdown label="Disabled" :disabled="true">
					Some dropdown content Some dropdown content Some dropdown content Some dropdown content
				</Dropdown>
				<Dropdown label="Dropdown" element="icon" icon="dots" title="Show dropdown">
					Some dropdown content Some dropdown content Some dropdown content Some dropdown content
				</Dropdown>
				<Dropdown>
					<template #toggler>Custom toggler</template>
					Some dropdown content Some dropdown content Some dropdown content Some dropdown content
				</Dropdown>
				<ButtonsGroup class="ml-a">
					<Button variant="outline">Button</Button>
					<Dropdown align="right" variant="outline">
						Some dropdown content Some dropdown content Some dropdown content Some dropdown content
					</Dropdown>
				</ButtonsGroup>
			</div>
			<Modal v-model:open="showDropdownInfo" header="Dropdown component">
				<div>
					<Accordion title="Code example" pre>
						{{ dropdownCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props - Dropdown" :properties="dropdownProps" />
				<TableProps header="Slots - Dropdown" :properties="dropdownSlots" />
				<TableProps header="Props - DropdownLink" :properties="dropdownLinkProps" />
				<TableProps header="Slots - DropdownLink" :properties="dropdownLinkSlots" />
			</Modal>
		</Card>
		<Card header="Tag">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showTagInfo = true" />
			</template>
			<div class="tags-row">
				<Tag color="primary">Primary</Tag>
				<Tag color="secondary">Secondary</Tag>
				<Tag>Heading</Tag>
				<Tag color="info">Info</Tag>
				<Tag color="success">Success</Tag>
				<Tag color="warning">Warning</Tag>
				<Tag color="danger">Danger</Tag>
				<Tag color="link">Link</Tag>
			</div>
			<h4>Solid</h4>
			<div class="tags-row line">
				<Tag color="primary" solid>Primary</Tag>
				<Tag color="secondary" solid>Secondary</Tag>
				<Tag solid>Heading</Tag>
				<Tag color="info" solid>Info</Tag>
				<Tag color="success" solid>Success</Tag>
				<Tag color="warning" solid>Warning</Tag>
				<Tag color="danger" solid>Danger</Tag>
				<Tag color="link" solid>Link</Tag>
			</div>
			<h4>Icons</h4>
			<div class="tags-row line">
				<Tag icon="search" clearable>Link search clearable</Tag>
				<Tag icon="search" solid>Link search solid</Tag>
			</div>
			<Modal v-model:open="showTagInfo" header="Tag component">
				<div>
					<Accordion title="Code example" pre>
						{{ tagCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="tagProps" />
			</Modal>
		</Card>
		<Card header="Loader">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showLoaderInfo = true" />
			</template>
			<Loader :loading="isLoading" :text="loadingText ? 'Loading...' : ''">
				<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed voluptates officia saepe dolor odit ratione blanditiis architecto nihil illo! Ducimus assumenda hic aliquid ad beatae non. Dolorum aliquam esse quia, inventore quod, numquam eos accusamus consequatur delectus perspiciatis repellat ad id laudantium aspernatur maxime commodi at iusto molestias? Libero perferendis sit amet reprehenderit quos vel cupiditate illo fugiat delectus aut, itaque, magni laborum voluptatum perspiciatis rem obcaecati saepe? Maiores mollitia sequi quasi tenetur, voluptatem nostrum temporibus quae impedit facere perferendis.</p>
			</Loader>
			<p class="buttons-row">
				<Button @click="isLoading = !isLoading">Toggle loader</Button>
				<Button @click="loadingText = !loadingText">Toggle text</Button>
			</p>
			<Modal v-model:open="showLoaderInfo" header="Loader component">
				<div>
					<Accordion title="Code example" pre>
						{{ loaderCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="loaderProps" />
			</Modal>
		</Card>
		<Card header="Utility classes">
			<TableProps header="Text classes" :properties="textClasses" hideDefaults />
			<TableProps header="Spacing classes" :properties="spacingClasses" hideDefaults />
			<TableProps header="Other classes" :properties="utilityClasses" hideDefaults />
		</Card>
	</AuthenticatedLayout>
</template>

<style>
.icons {
	display: flex;
	flex-wrap: wrap;
	gap: .5rem;
	font-size: 1.5rem;
}
.icons .icon {
	cursor: pointer;
}

.slideExample {
	padding: .75em 1.25em;
	border: 1px solid var(--border);
	background-color: var(--input-background);
}
</style>