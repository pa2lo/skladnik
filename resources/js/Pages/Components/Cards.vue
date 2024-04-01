<script setup>
import { ref } from 'vue'

import { toast } from '@/Utils/toaster'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import Modal from '@/Components/Modals/Modal.vue'
import Button from '@/Components/Elements/Button.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'
import TableProps from './Partials/TableProps.vue'
import Accordion from '@/Components/Elements/Accordion.vue'

import Tabs from '@/Components/Tabs/Tabs.vue'
import Tab from '@/Components/Tabs/Tab.vue'
import DashboardLinks from '@/Components/Widgets/DashboardLinks.vue'
import DashboardLink from '@/Components/Widgets/DashboardLink.vue'

const newTabVisible = ref(false)
const tab1text = ref(false)
const tabs1 = ref(null)
const tab2disabled = ref(false)
function switchTab(id) {
	tabs1.value?.setTab(id)
}

const showCardInfo = ref(false)
const cardExampleCode = `<Card header="Card" headerNote="Card headerNote">
 <template #actions>
  <IcoButton icon="code" transparent @click="showCardInfo = true" />
 </template>
 Card body
 <template #footer>
  Card footer text
 </template>
 <template #buttons>
  <Button variant="outline">Button 1</Button>
  <Button>Button 2</Button>
 </template>
</Card>`
const cardProps = [
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
		note: 'available: narrow | narrower | normal | wider | wide | full'
	}, {
		name: 'stickyFooter',
		type: 'Boolean',
		default: false
	}
]
const cardSlots = [
	{
		name: 'header',
		default: 'header and headerNote prop'
	}, {
		name: 'actions'
	}, {
		name: 'default',
		note: 'body'
	}, {
		name: 'footer'
	}, {
		name: 'buttons'
	}
]

const showTabsInfo = ref(false)
const tabsExampleCode = `<Tabs>
 <Tab name="tab 1" id="tab1">
  <template #trigger>slot trigger</template>
  {{ dynamicContent }}
 </Tab>
 <Tab name="tab 2" id="tab2" :disabled="tab2disabled">
  Tab 2 content
 </Tab>
 <Tab name="Tab 3" id="tab3" icon="right">
  Tab 3 content
 </Tab>
 <Tab v-if="newTabVisible" name="Tab 4" id="tab4">
  Tab 4 content
 </Tab>
 <Tab id="tab5" name="Tab 5" @mounted="toast.success('Tab mounted')">
  tab 5 content
 </Tab>
</Tabs>`
const tabsExpose = [
	{
		name: 'getActiveTabIndex',
		note: 'returns id or index of active tab'
	}, {
		name: 'setTab',
		parameters: 'id',
		note: 'set tab by id or index'
	}
]
const tabsProps = [
	{
		name: 'grow',
		type: 'Boolean',
		default: false
	}, {
		name: 'variant',
		type: 'String',
		default: 'underline',
		note: 'available: underline | outline | pill'
	}
]
const tabProps = [
	{
		name: 'name',
		type: 'String'
	}, {
		name: 'id',
		type: 'String'
	}, {
		name: 'icon',
		type: 'String',
		note: 'Trigger icon'
	}, {
		name: 'disabled',
		type: 'Boolean',
		default: false
	}
]
const tabSlots = [
	{
		name: 'trigger',
		default: 'name prop'
	}
]
const tabEvents = [
	{
		name: 'mounted'
	}
]

const showDashboardLinksInfo = ref(false)
const dashboardLinksCodeExample = `<DashboardLinks>
 <DashboardLink icon="stack" title="Widget 1" description="Widget 1 description" href="/" />
 <DashboardLink icon="components" title="Widget 2" href="/">
  <template #description>Widget 2 description slot</template>
 </DashboardLink>
 <DashboardLink icon="archive" href="/">Widget 3 slot</DashboardLink>
</DashboardLinks>`
const dashboardLinksProps = [
	{
		name: 'horizontal',
		type: 'Boolean',
		default: false
	}
]
const dashboardLinkProps = [
	{
		name: 'title',
		type: 'String'
	}, {
		name: 'description',
		type: 'String'
	}, {
		name: 'href',
		type: 'String'
	}, {
		name: 'icon',
		type: 'String'
	}
]
const dashboardLinkSlots = [
	{
		name: 'default',
		default: 'title prop'
	}, {
		name: 'description',
		default: 'description prop'
	}
]
</script>

<template>
	<AuthenticatedLayout header="Cards, tabs, widgets">
		<Card header="DashboardLinks">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showDashboardLinksInfo = true" />
			</template>
			<DashboardLinks>
				<DashboardLink icon="stack" title="Widget 1" description="Widget 1 description" href="/" />
				<DashboardLink icon="components" title="Widget 2" href="/">
					<template #description>Widget 2 description slot</template>
				</DashboardLink>
				<DashboardLink icon="archive" href="/">Widget 3 slot</DashboardLink>
			</DashboardLinks>
			<h4 class="divided">DshboardLinks horizontal</h4>
			<DashboardLinks horizontal>
				<DashboardLink icon="stack" title="Widget 1" description="Widget 1 description" href="/" />
				<DashboardLink icon="components" title="Widget 2 no link" description="Widget 2 description" href="/" />
				<DashboardLink icon="archive">Widget 3 slot</DashboardLink>
			</DashboardLinks>
			<Modal v-model:open="showDashboardLinksInfo" header="DashboardLinks component">
				<div>
					<Accordion title="Code example" pre>
						{{ dashboardLinksCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props - DashboardLinks" :properties="dashboardLinksProps" />
				<TableProps header="Props - DashboardLink" :properties="dashboardLinkProps" />
				<TableProps header="Slots - DashboardLink" :properties="dashboardLinkSlots" />
			</Modal>
		</Card>
		<Card header="Card" headerNote="Card headerNote">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showCardInfo = true" />
			</template>
			Card body
			<template #footer>
				Card footer text
			</template>
			<template #buttons>
				<Button variant="outline">Button 1</Button>
				<Button>Button 2</Button>
			</template>
			<Modal v-model:open="showCardInfo" header="Card component">
				<div>
					<Accordion title="Code example" pre>
						{{ cardExampleCode }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="cardProps" />
				<TableProps header="Slots" :properties="cardSlots" />
			</Modal>
		</Card>
		<Card header="Tabs">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showTabsInfo = true" />
			</template>
			<Tabs ref="tabs1">
				<Tab name="tab 1" id="tab1">
					<template #trigger>slot trigger</template>
					{{ tab1text ? 'Tab 1' : 'Tab 1 if false' }}
				</Tab>
				<Tab name="tab 2" id="tab2" :disabled="tab2disabled">
					Tab 2
				</Tab>
				<Tab name="Tab 3" id="tab3" icon="right">
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto sequi molestias provident iste eius debitis quasi quos similique. Exercitationem, dicta.
				</Tab>
				<Tab v-if="newTabVisible" name="Tab 4" id="tab4">
					Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum officia recusandae fuga soluta ea repellat quam vitae, optio quas. Aut omnis porro delectus ex deleniti? Soluta, itaque placeat, ratione nesciunt iste sapiente tenetur rem blanditiis expedita laudantium nulla hic perspiciatis.
				</Tab>
				<Tab id="tab5" name="Tab 5" @mounted="toast.success('Tab 5 mounted')">
					tab 5 content
				</Tab>
				<Tab name="Tab 6 longer name">
					tab 6 content
				</Tab>
				<Tab name="Tab 7 longer name">
					tab 7 content
				</Tab>
				<Tab name="Tab 8 longer name">
					tab 8 content
				</Tab>
			</Tabs>
			<p class="buttons-row">
				<Button @click="tab1text = !tab1text">change tab1 text</Button>
				<Button @click="newTabVisible = !newTabVisible">toggle tab4</Button>
				<Button @click="switchTab('tab3')">switch to tab3</Button>
				<Button @click="tab2disabled = !tab2disabled">toggle tab2 disabled</Button>
			</p>
			<h4 class="divided">Variants</h4>
			<h5>Underline</h5>
			<Tabs>
				<Tab name="Tab 1">Tab 1 content</Tab>
				<Tab name="Tab 2" disabled="1">Tab 2 content</Tab>
				<Tab name="Tab 3">Tab 3 content</Tab>
				<Tab name="Tab 4 longer">Tab 4 content</Tab>
				<Tab name="Tab 5">Tab 5 content</Tab>
			</Tabs>
			<h5>Outline</h5>
			<Tabs variant="outline">
				<Tab name="Tab 1">Tab 1 content</Tab>
				<Tab name="Tab 2" disabled="1">Tab 2 content</Tab>
				<Tab name="Tab 3">Tab 3 content</Tab>
				<Tab name="Tab 4 longer">Tab 4 content</Tab>
				<Tab name="Tab 5">Tab 5 content</Tab>
			</Tabs>
			<h5>Pill</h5>
			<Tabs variant="pill">
				<Tab name="Tab 1">Tab 1 content</Tab>
				<Tab name="Tab 2" disabled="1">Tab 2 content</Tab>
				<Tab name="Tab 3">Tab 3 content</Tab>
				<Tab name="Tab 4 longer">Tab 4 content</Tab>
				<Tab name="Tab 5">Tab 5 content</Tab>
			</Tabs>
			<h4>Grow</h4>
			<Tabs grow>
				<Tab name="Tab 1">Tab 1 content</Tab>
				<Tab name="Tab 2" disabled="1">Tab 2 content</Tab>
				<Tab name="Tab 3">Tab 3 content</Tab>
				<Tab name="Tab 4 longer">Tab 4 content</Tab>
				<Tab name="Tab 5">Tab 5 content</Tab>
			</Tabs>
			<Modal v-model:open="showTabsInfo" header="Tabs component">
				<div>
					<Accordion title="Code example" pre>
						{{ tabsExampleCode }}
					</Accordion>
				</div>
				<TableProps header="Exposed functions" :properties="tabsExpose" hideDefaults />
				<TableProps header="Props - Tabs" :properties="tabsProps" />
				<TableProps header="Props - Tab" :properties="tabProps" />
				<TableProps header="Slots - Tab" :properties="tabSlots" />
				<TableProps header="Events - Tab" :properties="tabEvents" hideDefaults />
			</Modal>
		</Card>
	</AuthenticatedLayout>
</template>