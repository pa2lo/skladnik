<script setup>
import { ref } from 'vue'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Card from '@/Components/Elements/Card.vue'
import Modal from '@/Components/Modals/Modal.vue'
import Button from '@/Components/Elements/Button.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'
import TableProps from './Partials/TableProps.vue'
import Accordion from '@/Components/Elements/Accordion.vue'

import TextInput from '@/Components/Inputs/TextInput.vue'
import BasicColorInput from '@/Components/Inputs/BasicColorInput.vue'
import BasicSelectInput from '@/Components/Inputs/BasicSelectInput.vue'
import SelectInput from '@/Components/Inputs/SelectInput.vue'
import CheckboxGroup from '@/Components/Inputs/CheckboxGroup.vue'
import RadioGroup from '@/Components/Inputs/RadioGroup.vue'
import ToggleGroup from '@/Components/Inputs/ToggleGroup.vue'
import SimpleCheckbox from '@/Components/Inputs/SimpleCheckbox.vue'
import SimpleToggle from '@/Components/Inputs/SimpleToggle.vue'
import TextareaInput from '@/Components/Inputs/TextareaInput.vue'
import RadioButtons from '@/Components/Inputs/RadioButtons.vue'
import NumberInput from '@/Components/Inputs/NumberInput.vue'
import InputsRow from '@/Components/Inputs/InputsRow.vue'
import FileInput from '@/Components/Inputs/FileInput.vue'
import TextEditorInput from '@/Components/Inputs/TextEditorInput.vue'
import RangeInput from '@/Components/Inputs/RangeInput.vue'

const textInputTest = ref('')
const textInputTest2 = ref('')
const testColorInput = ref('#334578')
const selectInputTest = ref('')
const selectInputMultipleTest = ref([])
const numberInputTest = ref(10)
const cbGroupTest = ref(['option2', 'option4'])
const radioButtonsTest = ref('option2')
const radioGroupTest = ref('option2')
const radioGroupTest2 = ref('option4')
const toggleGroupTest = ref(['option2', 'option4'])
const cbTest = ref(false)
const textEditorTest = ref('')
const rangeInputTest = ref(2)
const rangeInputTest2 = ref(4)
const combinedNumberTest = ref(6)

const selectOptions = []
for (let i = 1; i < 5; i++) {
	let newOption = {
		title: `Optione ${i}`,
		value: `option${i}`
	}
	if (i == 3 || i == 4) newOption.disabled = true
	selectOptions.push(newOption)
}

const radioButtonsOptions = [
	{
		title: 'Opt 1',
		value: 'option1'
	}, {
		title: 'Opt 2',
		value: 'option2'
	}, {
		icon: 'archive',
		tooltip: 'icon & tooltip',
		value: 'option3'
	}, {
		title: 'plus',
		icon: 'plus',
		value: 'option4',
		disabled: true
	}
]
const radioButtonsOptionsColored = [
	{
		title: 'Opt 1',
		value: 'option1',
		color: 'secondary',
		tooltip: 'secondary'
	}, {
		title: 'Opt 2',
		value: 'option2',
		color: 'success',
		tooltip: 'success'
	}, {
		icon: 'archive',
		tooltip: 'icon & tooltip, warning',
		value: 'option3',
		color: 'warning'
	}, {
		title: 'plus',
		icon: 'plus',
		value: 'option4',
		color: 'heading',
		tooltip: 'heading'
	}
]

const textareaTest1 = ref("Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, perferendis voluptatibus. Officia incidunt eos assumenda tempore sint minima, quaerat inventore!")

const plusminus = [
	{
		value: 'plus',
		icon: 'plus',
		tooltip: 'Plus'
	}, {
		value: 'minus',
		icon: 'minus',
		tooltip: 'Minus'
	}
]
const plusminusTest = ref('plus')

const inputSharedProps = [
	{
		name: 'label',
		type: 'String'
	}, {
		name: 'labelNote',
		type: 'String',
		note: 'lighter text in label'
	}, {
		name: 'name',
		type: 'String'
	}, {
		name: 'required',
		type: 'Boolean',
		default: false
	}, {
		name: 'disabled',
		type: 'Boolean',
		default: false
	}, {
		name: 'readOnly',
		type: 'Boolean',
		default: false
	}, {
		name: 'error',
		type: 'String'
	}, {
		name: 'placeholder',
		type: 'String'
	}, {
		name: 'autofocus',
		type: 'Boolean',
		default: false
	}, {
		name: 'autocomplete',
		type: 'String'
	}, {
		name: 'clearable',
		type: 'Boolean',
		default: false
	}, {
		name: 'copyable',
		type: 'Boolean',
		default: false
	}, {
		name: 'icon',
		type: 'String'
	}, {
		name: 'type',
		type: 'String',
		default: 'text',
		note: 'input type: <i>password</i>, <i>datetime-local</i>...'
	}, {
		name: 'rows',
		type: 'Number',
		default: 4
	}, {
		name: 'options',
		type: 'Array',
		note: 'structure in code example'
	}, {
		name: 'allowEmpty',
		type: 'Boolean',
		default: false
	}, {
		name: 'min',
		type: 'Number'
	}, {
		name: 'max',
		type: 'Number'
	}, {
		name: 'step',
		type: 'Number',
		default: 1
	}, {
		name: 'inc',
		type: 'Number',
		note: 'buttons increment - inherits step prop'
	}, {
		name: 'chars',
		type: 'Number',
		note: 'length of input for horizontal and row view'
	}, {
		name: 'suffix',
		type: 'String'
	}, {
		name: 'value',
		type: 'Any',
		default: 'null',
		note: 'inputs value attribute'
	}, {
		name: 'wrap',
		type: 'Boolean',
		default: false,
		note: 'break content into multiple lines'
	}, {
		name: 'vertical',
		type: 'Boolean',
		default: false,
		note: 'display options vertically'
	}, {
		name: 'horizontal',
		type: 'Boolean',
		default: false
	}, {
		name: 'full',
		type: 'Boolean',
		default: false
	}, {
		name: 'tooltip',
		type: 'String'
	}
]
const inputSharedSlots = [
	{
		name: 'default',
		note: 'input note'
	}
]
const inputSharedOptionProps = [
	{
		name: 'title',
		type: 'String'
	}, {
		name: 'value',
		type: 'String',
		note: 'input value attribute'
	}, {
		name: 'icon',
		type: 'String'
	}, {
		name: 'disabled',
		type: 'Boolean',
		default: false
	}, {
		name: 'color',
		type: 'String',
		default: 'link',
		note: 'available: link | primary | secondary | info | success | warning | danger | heading'
	}, {
		name: 'tooltip',
		type: 'String'
	}
]
const inputSharedExpose = [
	{
		name: 'focus',
		note: 'focus input element'
	}
]
const selectOptionProps = [...inputSharedOptionProps.filter(i => ['title', 'value', 'disabled'].includes(i.name))]

const showTextInputInfo = ref(false)
const textInputCodeExample = `<TextInput label="Input 1" placeholder="Placeholder" v-model="textInputModel">Input note</TextInput>
<TextInput label="Input 2" placeholder="Placeholder" v-model="textInputModel" error="Error message" clearable />
<TextInput label="Input 3" icon="mail" modelValue="input is disabled" disabled />
<TextInput label="Input 4" modelValue="Read only" readOnly copyable />`
const textInputProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'readOnly', 'error', 'placeholder', 'autofocus', 'autocomplete', 'clearable', 'copyable', 'icon', 'type', 'chars', 'horizontal', 'full', 'tooltip'].includes(i.name)), {
	name: 'min',
	type: '[String, Number]',
	note: 'min date f.e. on input type date'
}, {
	name: 'max',
	type: '[String, Number]',
	note: 'max date f.e. on input type date'
}, {
	name: 'trim',
	type: 'Boolean',
	default: false,
	note: 'Trim value on blur'
}]

const showBasicColorInputInfo = ref(false)
const basicColorInputCodeExample = `<BasicColorInput label="Color input 1" v-model="colorInputModel" placeholder="#1a2b3c">Input note</BasicColorInput>
<BasicColorInput label="Color input 2" v-model="colorInputModel" placeholder="#1a2b3c" error="Error message" />
<BasicColorInput label="Color input 3" v-model="colorInputModel" readOnly copyable />`
const basicColorInputProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'readOnly', 'error', 'placeholder', 'autofocus', 'copyable', 'horizontal', 'full', 'tooltip'].includes(i.name))]

const showTextareaInfo = ref(false)
const textareaCodeExample = `<TextareaInput label="Text area 1" v-model="textareaModel">Input note</TextareaInput>
<TextareaInput label="Text area 2" v-model="textareaModel" error="Input error" clearable />
<TextareaInput label="Text area 3" v-model="textareaModel" rows="3" copyable readOnly />
<TextareaInput label="Text area 4" v-model="textareaModel" rows="3" disabled />`
const textareaProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'readOnly', 'error', 'placeholder', 'autofocus', 'clearable', 'copyable', 'rows', 'horizontal', 'full', 'tooltip'].includes(i.name))]

const showNumberInputInfo = ref(false)
const numberInputCodeExample = `<NumberInput label="Number 1" v-model="numberModel">Input note</NumberInput>
<NumberInput label="Number 2" :min="5" :max="15" :step="0.1" :inc="0.5" v-model="numberModel" suffix="km" error="Input error" />
<NumberInput label="Number 3" v-model="numberModel" readOnly />
<NumberInput label="Number 4" v-model="numberModel" disabled />`
const numberInputProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'readOnly', 'error', 'placeholder', 'autofocus', 'autocomplete', 'min', 'max', 'step', 'inc', 'chars', 'suffix', 'horizontal', 'full', 'tooltip'].includes(i.name)), {
	name: 'hideButtons',
	type: 'Boolean',
	default: false
}]

const showBasicSelectInfo = ref(false)
const basicSelectCodeExample = `const selectOptions1 = ['option1', 'option2', 'option3']
const selectOptions2 = [{
 title: 'Option 1',
 value: 'option1'
}, {
 title: 'Option 2',
 value: 'option2'
}, {
 title: 'Option 3',
 value: 'option3',
 disabled: true
}]

<BasicSelectInput label="Select 1" :options="selectOptions1" v-model="selectModel" allowEmpty>Input note</BasicSelectInput>
<BasicSelectInput label="Select 2" :options="selectOptions2" v-model="selectModel" error="Input error" />
<BasicSelectInput label="Select 3" icon="mail" :options="selectOptions1" modelValue="option2" readOnly />
<BasicSelectInput label="Select 4" disabled :options="selectOptions2" modelValue="option2" />`
const basicSelectProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'readOnly', 'error', 'autofocus', 'autocomplete', 'icon', 'options', 'allowEmpty', 'horizontal', 'full', 'tooltip'].includes(i.name)), {
	name: 'placeholder',
	type: 'String',
	default: 'Select...',
	note: 'empty option text'
}]

const showSelectInfo = ref(false)
const selectCodeExample = `const selectOptions = [{
 title: 'Option 1',
 value: 'option1'
}, {
 title: 'Option 2',
 value: 'option2'
}, {
 title: 'Option 3',
 value: 'option3',
 disabled: true
}]

const selectAjaxOptions = ref([])
const selectAjaxLoading = ref(false)
function loadAjaxOptions(val) {
	// API query for val
}

<SelectInput label="Select 1" :options="selectOptions" v-model="selectModel" allowEmpty>Input note</SelectInput>
<SelectInput label="Select 2 multiple" :options="selectOptions" v-model="selectModelArray" />
<SelectInput label="Select 3 option slot" :options="selectOptions" v-model="selectModel">
 <template #option="{ option }">
  <strong>Title: {{ option.title }}</strong>
  <br><span class="smaller text-light">Value - {{ option.value }}</span>
 </template>
</SelectInput>
<SelectInput label="Select ajax search" :options="selectAjaxOptions" :loading="selectAjaxLoading" @search="loadAjaxOptions" />`
const selectProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'readOnly', 'error', 'options', 'allowEmpty', 'horizontal', 'full', 'tooltip'].includes(i.name)), {
	name: 'placeholder',
	type: 'String',
	default: 'Select...',
	note: 'empty option text'
},  {
	name: 'showCount',
	type: 'Boolean',
	default: false,
	note: 'show number of selected items instead of items itself'
}, {
	name: 'searchable',
	type: 'Boolean',
	default: false,
	note: 'show search input in options'
}, {
	name: 'searchableFields',
	type: 'Array',
	default: '[]',
	note: 'option object keys to search ih'
}, {
	name: 'searchPlaceholder',
	type: 'String',
	default: 'Search...'
}, {
	name: 'loading',
	type: 'Boolean',
	default: false,
	note: 'options loading indicator'
}, {
	name: 'noItemsText',
	type: 'String',
	default: 'no items'
}, {
	name: 'searchThrottle',
	type: 'Number',
	default: 250
}]
const selectSlots = [...inputSharedSlots, {
	name: 'option',
	scope: 'option',
	default: 'option.title',
	note: 'select option scoped slot'
}]
const selectEvents = [{
	name: 'search',
	parameters: 'value',
	note: 'search input events for ajax options lookup'
}]

const showRadioButtonsInfo = ref(false)
const radioButtonsCodeExample = `const options = [{
 title: 'Opt 1',
 value: 'option1'
}, {
 title: 'Opt 2',
 value: 'option2',
 disabled: true
}, {
 icon: 'archive',
 tooltip: 'icon & tooltip',
 value: 'option3'
}, {
 title: 'plus',
 icon: 'plus',
 value: 'option4',
 color: 'secondary'
}]

<RadioButtons label="Radio buttons 1" :options="options" v-model="radioButtonsModel">Input note</RadioButtons>
<RadioButtons label="Radio buttons 2" :options="options" v-model="radioButtonsModel" error="Buttons row error" />
<RadioButtons label="Radio buttons 3" :options="options" v-model="radioButtonsModel" readOnly />
<RadioButtons label="Radio buttons 4" :options="options" v-model="radioButtonsModel" disabled />`
const radioButtonsProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'readOnly', 'error', 'options', 'horizontal', 'full', 'tooltip'].includes(i.name)), {
	name: 'solid',
	type: 'Boolean',
	default: false,
	note: 'selected option with solid color'
}, {
	name: 'sameWidth',
	type: 'Boolean',
	default: false,
	note: 'options will have same width'
}]

const showSimpleCheckboxInfo = ref(false)
const showSimpleToggleInfo = ref(false)
const simpleCheckboxCodeExample = `<SimpleCheckbox label="Checkbox 1" v-model="checkboxModel" />
<SimpleCheckbox v-model="checkboxModel" disabled>Checkbox 2 slot</SimpleCheckbox>`
const simpleToggleCodeExample = `<SimpleToggle label="Toggle 1" v-model="toggleModel" />
<SimpleToggle v-model="toggleModel" disabled>Toggle 2 slot</SimpleToggle>`
const simpleCheckboxProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'value', 'horizontal', 'full', 'tooltip'].includes(i.name))]
const simpleCheckboxSlots = [{
	name: 'default',
	default: 'label prop',
	note: 'text'
}]
const simpleCheckboxExpose = [{
	name: 'setIndeterminate',
	parameters: 'boolean',
	note: 'set indeterminate state'
}]

const showGroupInputInfo = ref(false)
const groupInputCodeExample = `const options = [{
 title: 'Option 1',
 value: 'option1'
}, {
 title: 'Option 2',
 value: 'option2'
}, {
 title: 'Option 3',
 value: 'option3',
 disabled: true
}]

<CheckboxGroup label="CheckboxGroup" :options="options" v-model="checkboxModel">Input note</CheckboxGroup>
<RadioGroup label="RadioGroup" :options="options" v-model="radioModel" />
<ToggleGroup label="ToggleGroup full" :options="options" v-model="togglesModel" full />`
const groupInputProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'error', 'options', 'vertical', 'horizontal', 'full', 'tooltip'].includes(i.name))]

const showInputsRowInfo = ref(false)
const inputsRowCodeExample = `<InputsRow label="Different inputs in one row without labels">
 <RadioButtons :options="options" v-model="radioModel" />
 <TextInput class="grow" v-model="textModel" placeholder="Placeholder" />
 <Button>Button</Button>
 <template #note>InputsRow note slot</template>
</InputsRow>
<InputsRow error="InputsRow error message" wrap>
 <RadioButtons label="Radio" :options="options" v-model="radioModel" />
 <BasicSelectInput class="grow" label="Select" :options="selectOptions" v-model="selectModel" error=" " />
 <TextInput class="grow" label="Text" placeholder="Placeholder" v-model="textModel" :chars="10" />
</InputsRow>`
const inputsRowProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'error', 'wrap', 'horizontal', 'full', 'tooltip'].includes(i.name))]
const inputsRowSlots = [
	{
		name: 'default',
		note: 'components in row'
	}, {
		name: 'note',
		default: ''
	}
]

const inputDateModel = ref('')
const inputPasswordModel = ref('password')
const inputTimeModel = ref('')
const inputDateTimeModel = ref('')

const showFileInputInfo = ref(false)
const fileInputCodeExample = `<FileInput label="File input" @setFile="(file) => form.file = file" />
<FileInput label="File input image 200kb" accept="image/*" :maxSize="200000" @setFile="setFileCallback" />
<FileInput fileName="example.jpg" fileUrl="/img/example.jpg" label="File input 2" accept="image/*" @setFile="setFileCallback" />`
const fileInputProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'error', 'horizontal', 'full', 'tooltip'].includes(i.name)), {
	name: 'fileName',
	type: 'String'
}, {
	name: 'fileUrl',
	type: 'String'
}, {
	name: 'previewImage',
	type: 'String',
	note: 'smaller size for preview'
}, {
	name: 'maxSize',
	type: 'Number',
	note: 'max size in bytes'
}, {
	name: 'placeholder',
	type: 'String',
	default: 'Select file',
	note: 'select button text'
}, {
	name: 'accept',
	type: 'String',
	note: 'input accept attribute (image/*...)'
}]
const fileInputEvents = [
	{
		name: 'setFile',
		parameters: 'file',
		note: 'after file change on input'
	}
]

const showRangeInfo = ref(false)
const rangeCodeExample = `<RangeInput label="Range 1" v-model="rangeModel">Input note</RangeInput>
<RangeInput label="Range 2" suffix="kw" :min="1" :max="9" :step="0.1" v-model="rangeModel2" />`
const rangeProps = [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'error', 'step', 'suffix', 'horizontal', 'full', 'tooltip'].includes(i.name)), {
	name: 'min',
	type: 'Number',
	default: 0
}, {
	name: 'max',
	type: 'Number',
	default: 10
}]

const showTextEditorInfo = ref(false)
const textEditorCodeExample = `<TextEditorInput label="Text editor simple" simple v-model="textModel">Input note</TextEditorInput>
<TextEditorInput label="Text editor" placeholder="Add your content here..." v-model="textModel2" />`
const textEditorProps =  [...inputSharedProps.filter(i => ['label', 'labelNote', 'name', 'required', 'disabled', 'error', 'placeholder', 'tooltip'].includes(i.name)), {
	name: 'height',
	type: 'String',
	default: '400px',
	note: 'editor height in px / rem...<br>defaults to 177px for simple editor'
}, {
	name: 'simple',
	type: 'Boolean',
	default: false
}]

// ajax options loading
const selectAjaxOptions = ref([])
const selectAjaxLoading = ref(false)
function loadAjaxOptions(v) {
	selectAjaxLoading.value = true
	setTimeout(() => {
		selectAjaxLoading.value = false
	}, 1000);
}
</script>

<template>
	<AuthenticatedLayout header="Inputs">
		<Card header="TextInput">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showTextInputInfo = true" />
			</template>
			<div class="inputs-grid">
				<TextInput label="Text input" v-model="textInputTest" placeholder="Placeholder">Input note</TextInput>
				<TextInput label="Text input with error" placeholder="Another placeholder" v-model="textInputTest" error="Text input error" clearable />
				<TextInput label="Input readonly copyable wIcon" icon="mail" modelValue="Read only value" readOnly copyable />
				<TextInput label="Text input disabled" modelValue="input is disabled" disabled />
			</div>
			<h4>Input types</h4>
			<div class="inputs-grid">
				<TextInput label="Password input" type="password" v-model="inputPasswordModel" />
				<TextInput label="Time input" type="time" v-model="inputTimeModel" />
				<TextInput label="Date input" type="date" v-model="inputDateModel" />
				<TextInput label="Datetime-local input" type="datetime-local" v-model="inputDateTimeModel" />
			</div>
			<Modal v-model:open="showTextInputInfo" header="TextInput component">
				<div>
					<Accordion title="Code example" pre>
						{{ textInputCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="textInputProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
				<TableProps header="Exposed functions" :properties="inputSharedExpose" hideDefaults />
			</Modal>
		</Card>
		<Card header="BasicColorInput">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showBasicColorInputInfo = true" />
			</template>
			<div class="inputs-grid">
				<BasicColorInput label="Color input" v-model="testColorInput" placeholder="#1a2b3c">Input note</BasicColorInput>
				<BasicColorInput label="Color input with error" v-model="testColorInput" placeholder="#1a2b3c" error="Input error" />
				<BasicColorInput label="Color input readOnly copyable" v-model="testColorInput" readOnly copyable />
				<BasicColorInput label="Color input disabled" v-model="testColorInput" disabled />
			</div>
			<Modal v-model:open="showBasicColorInputInfo" header="BasicColorInput component">
				<div>
					<Accordion title="Code example" pre>
						{{ basicColorInputCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="basicColorInputProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
				<TableProps header="Exposed functions" :properties="inputSharedExpose" hideDefaults />
			</Modal>
		</Card>
		<Card header="TextareaInput">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showTextareaInfo = true" />
			</template>
			<div class="inputs-grid">
				<TextareaInput label="Text area input" v-model="textareaTest1">Input note</TextareaInput>
				<TextareaInput label="Text area error clearable" v-model="textareaTest1" error="Input error" clearable />
				<TextareaInput label="Text area readOnly 3 rows copyable" v-model="textareaTest1" rows="3" copyable readOnly />
				<TextareaInput label="Text area disabled 3 rows" v-model="textareaTest1" rows="3" disabled />
			</div>
			<Modal v-model:open="showTextareaInfo" header="TextareaInput component">
				<div>
					<Accordion title="Code example" pre>
						{{ textareaCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="textareaProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
				<TableProps header="Exposed functions" :properties="inputSharedExpose" hideDefaults />
			</Modal>
		</Card>
		<Card header="BasicSelectInput">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showBasicSelectInfo = true" />
			</template>
			<div class="inputs-grid">
				<BasicSelectInput label="Select input allowEmpty" :options="selectOptions" v-model="selectInputTest" allowEmpty>Input note</BasicSelectInput>
				<BasicSelectInput label="Select input error" placeholder="Custom placeholder..." :options="selectOptions" v-model="selectInputTest" error="Input error" />
				<BasicSelectInput label="Select readOnly wIcon" icon="mail" :options="selectOptions" modelValue="option2" readOnly />
				<BasicSelectInput label="Select disabled" disabled :options="selectOptions" modelValue="option2" />
			</div>
			<Modal v-model:open="showBasicSelectInfo" header="BasicSelectInput component">
				<div>
					<Accordion title="Code example" pre>
						{{ basicSelectCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="basicSelectProps" />
				<TableProps header="Option item data" :properties="selectOptionProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
				<TableProps header="Exposed functions" :properties="inputSharedExpose" hideDefaults />
			</Modal>
		</Card>
		<Card header="SelectInput" headerNote="JS driven select input">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showSelectInfo = true" />
			</template>
			<div class="inputs-grid">
				<SelectInput label="Select input allowEmpty" :options="selectOptions" v-model="selectInputTest" allowEmpty>Input note</SelectInput>
				<SelectInput label="Select input error" placeholder="Custom placeholder..." :options="selectOptions" v-model="selectInputTest" error="Input error" />
				<SelectInput label="Select input multiple" :options="selectOptions" v-model="selectInputMultipleTest" />
				<SelectInput label="Select multiple searchable" :options="selectOptions" v-model="selectInputMultipleTest" searchable />
				<SelectInput label="Select custom slot" :options="selectOptions" v-model="selectInputTest">
					<template #option="{ option }">
						<strong>Title: {{ option.title }}</strong>
						<br><span class="smaller text-light">Value - {{ option.value }}</span>
					</template>
				</SelectInput>
				<SelectInput label="Select disabled" disabled :options="selectOptions" modelValue="option2" />
				<SelectInput label="Select multiple disabled" disabled :options="selectOptions" :modelValue="['option2', 'option4']" />
				<SelectInput label="Select multiple readOnly" readOnly :options="selectOptions" :modelValue="['option2', 'option4']" />
				<SelectInput label="Select multiple showCount" :options="selectOptions" v-model="selectInputMultipleTest" showCount />
				<SelectInput label="Select ajax search" :options="selectAjaxOptions" :loading="selectAjaxLoading" @search="loadAjaxOptions" />
			</div>
			<Modal v-model:open="showSelectInfo" header="SelectInput component">
				<div>
					<Accordion title="Code example" pre>
						{{ selectCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="selectProps" />
				<TableProps header="Option item data" :properties="selectOptionProps" />
				<TableProps header="Slots" :properties="selectSlots" />
				<TableProps header="Events" :properties="selectEvents" hideDefaults />
			</Modal>
		</Card>
		<Card header="RadioButtonsInput">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showRadioButtonsInfo = true" />
			</template>
			<div class="inputs-grid">
				<RadioButtons label="Select option" :options="radioButtonsOptions" v-model="radioButtonsTest">Input note</RadioButtons>
				<RadioButtons label="Select option with error & colors" :options="radioButtonsOptionsColored" v-model="radioButtonsTest" error="Buttons row error" />
				<RadioButtons label="Select option (readOnly)" :options="radioButtonsOptions" v-model="radioButtonsTest" readOnly />
				<RadioButtons label="Select option (disabled)" :options="radioButtonsOptions" v-model="radioButtonsTest" disabled />
				<RadioButtons label="Select option solid with colors" :options="radioButtonsOptionsColored" v-model="radioButtonsTest" solid />
				<RadioButtons label="Select option solid (disabled)" :options="radioButtonsOptions" v-model="radioButtonsTest" solid disabled />
			</div>
			<Modal v-model:open="showRadioButtonsInfo" header="RadioButtons component">
				<div>
					<Accordion title="Code example" pre>
						{{ radioButtonsCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="radioButtonsProps" />
				<TableProps header="Option item data" :properties="inputSharedOptionProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
			</Modal>
		</Card>
		<Card header="NumberInput">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showNumberInputInfo = true" />
			</template>
			<div class="inputs-grid">
				<NumberInput label="Number input label" v-model="numberInputTest">Input note</NumberInput>
				<NumberInput label="Number input min/max/step/inc/suffix/error" :min="5" :max="15" :step="0.1" :inc="0.5" error="Input error" v-model="numberInputTest" suffix="km" />
				<NumberInput label="Number input readonly" v-model="numberInputTest" readOnly />
				<NumberInput label="Number input disabled" v-model="numberInputTest" disabled />
				<NumberInput label="Number input hideButtons" hideButtons v-model="numberInputTest" />
			</div>
			<Modal v-model:open="showNumberInputInfo" header="NumberInput component">
				<div>
					<Accordion title="Code example" pre>
						{{ numberInputCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="numberInputProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
				<TableProps header="Exposed functions" :properties="inputSharedExpose" hideDefaults />
			</Modal>
		</Card>
		<Card header="FileInput">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showFileInputInfo = true" />
			</template>
			<div class="inputs-grid">
				<FileInput label="File input" />
				<FileInput label="File input image 200kb" accept="image/*" :maxSize="200000" />
				<FileInput disabled fileName="example.jpg" fileUrl="/img/example.jpg" label="File input disabled" accept="image/*" />
				<FileInput readOnly fileName="example.jpg" fileUrl="/img/example.jpg" label="File input readOnly" accept="image/*" />
			</div>
			<Modal v-model:open="showFileInputInfo" header="FileInput component">
				<div>
					<Accordion title="Code example" pre>
						{{ fileInputCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="fileInputProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
				<TableProps header="Events" :properties="fileInputEvents" hideDefaults />
			</Modal>
		</Card>
		<Card header="SimpleCheckbox">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showSimpleCheckboxInfo = true" />
			</template>
			<div class="inputs-grid">
				<SimpleCheckbox label="SimpleCheckbox" v-model="cbTest" />
				<SimpleCheckbox :modelValue="true" disabled>SimpleCheckbox disabled <a href="#">w slot</a></SimpleCheckbox>
			</div>
			<Modal v-model:open="showSimpleCheckboxInfo" header="SimpleCheckbox component">
				<div>
					<Accordion title="Code example" pre>
						{{ simpleCheckboxCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="simpleCheckboxProps" />
				<TableProps header="Slots" :properties="simpleCheckboxSlots" />
				<TableProps header="Exposed functions" :properties="simpleCheckboxExpose" hideDefaults />
			</Modal>
		</Card>
		<Card header="SimpleToggle">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showSimpleToggleInfo = true" />
			</template>
			<div class="inputs-grid">
				<SimpleToggle label="SimpleToggle" v-model="cbTest" />
				<SimpleToggle :modelValue="true" disabled>SimpleToggle disabled <a href="#">w slot</a></SimpleToggle>
			</div>
			<Modal v-model:open="showSimpleToggleInfo" header="SimpleToggle component">
				<div>
					<Accordion title="Code example" pre>
						{{ simpleToggleCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="simpleCheckboxProps" />
				<TableProps header="Slots" :properties="simpleCheckboxSlots" />
			</Modal>
		</Card>
		<Card header="Input groups" headerNote="Checkbox / radio / toggle">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showGroupInputInfo = true" />
			</template>
			<div class="inputs-grid">
				<CheckboxGroup label="CheckboxGroup" :options="selectOptions" v-model="cbGroupTest">
					values: {{ cbGroupTest }}
				</CheckboxGroup>
				<RadioGroup label="RadioGroup" :options="selectOptions" v-model="radioGroupTest">
					values: {{ radioGroupTest }}
				</RadioGroup>
				<ToggleGroup full label="ToggleGroup full" :options="selectOptions" v-model="toggleGroupTest">
					values: {{ toggleGroupTest }}
				</ToggleGroup>
			</div>
			<Modal v-model:open="showGroupInputInfo" header="Group input components">
				<div>
					<Accordion title="Code example" pre>
						{{ groupInputCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="groupInputProps" />
				<TableProps header="Option item data" :properties="selectOptionProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
			</Modal>
		</Card>
		<Card header="RangeInpu">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showRangeInfo = true" />
			</template>
			<div class="inputs-grid">
				<RangeInput label="Range input" v-model="rangeInputTest">Input note</RangeInput>
				<RangeInput label="Range input suffix/step/min/max" suffix="kw" :min="1" :max="9" :step="0.1" v-model="rangeInputTest2" />
				<RangeInput label="Range input disabled" disabled v-model="rangeInputTest" />
			</div>
			<Modal v-model:open="showRangeInfo" header="RangeInput component">
				<div>
					<Accordion title="Code example" pre>
						{{ rangeCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="rangeProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
			</Modal>
		</Card>
		<Card header="InputsRow">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showInputsRowInfo = true" />
			</template>
			<div class="inputs-grid">
				<InputsRow label="Different inputs in one row without labels">
					<RadioButtons :options="plusminus" v-model="plusminusTest" />
					<TextInput class="grow" v-model="textInputTest" placeholder="Placeholder" />
					<Button>Button</Button>
					<template #note>InputsRow note slot</template>
				</InputsRow>
				<InputsRow error="InputsRow error message" wrap>
					<RadioButtons label="Radio" :options="plusminus" v-model="plusminusTest" />
					<BasicSelectInput class="grow" label="Select" :options="selectOptions" v-model="selectInputTest" error=" " />
					<TextInput class="grow" label="Text" placeholder="Placeholder" v-model="textInputTest" :chars="10" />
				</InputsRow>
				<InputsRow label="Combined input">
					<RangeInput class="grow as-c" :min="4" :max="12" suffix="km" v-model="combinedNumberTest" />
					<NumberInput :min="4" :max="12" suffix="km" :chars="2" v-model="combinedNumberTest" />
				</InputsRow>
			</div>
			<Modal v-model:open="showInputsRowInfo" header="InputsRow component">
				<div>
					<Accordion title="Code example" pre>
						{{ inputsRowCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="inputsRowProps" />
				<TableProps header="Slots" :properties="inputsRowSlots" />
			</Modal>
		</Card>
		<Card header="Vertical input groups">
			<div class="inputs-grid cols3">
				<CheckboxGroup label="CheckboxGroup vertical" vertical :options="selectOptions" v-model="cbGroupTest">
					values: {{ cbGroupTest }}
				</CheckboxGroup>
				<RadioGroup label="RadioGroup vertical" vertical :options="selectOptions" v-model="radioGroupTest2">
					values: {{ radioGroupTest2 }}
				</RadioGroup>
				<ToggleGroup label="ToggleGroup vertical" vertical :options="selectOptions" v-model="toggleGroupTest">
					values: {{ toggleGroupTest }}
				</ToggleGroup>
			</div>
		</Card>
		<Card header="TextEditorInput" headerNote="TinyMCE wrapper">
			<template #actions>
				<IcoButton icon="code" v-tooltip="'Code & info'" transparent @click="showTextEditorInfo = true" />
			</template>
			<TextEditorInput label="Text editor simple" simple v-model="textEditorTest">Input note</TextEditorInput>
			<TextEditorInput label="Text editor full" placeholder="Add your content here..." v-model="textEditorTest" />
			<Modal v-model:open="showTextEditorInfo" header="TextEditorInput component">
				<div>
					<Accordion title="Code example" pre>
						{{ textEditorCodeExample }}
					</Accordion>
				</div>
				<TableProps header="Props" :properties="textEditorProps" />
				<TableProps header="Slots" :properties="inputSharedSlots" />
			</Modal>
		</Card>
		<Card header="Horizontal inputs">
			<TextInput horizontal label="TextInput horizontal" v-model="textInputTest" placeholder="Placeholder" tooltip="Tooltip" />
			<BasicColorInput horizontal label="BasicColorInput horizontal" v-model="testColorInput" placeholder="#1a2b3c" tooltip="Tooltip" />
			<BasicSelectInput horizontal label="BasicSelectInput horizontal" :options="selectOptions" v-model="selectInputTest" tooltip="Tooltip" />
			<SelectInput horizontal label="SelectInput horizontal" :options="selectOptions" v-model="selectInputMultipleTest" tooltip="Tooltip" />
			<FileInput horizontal label="FileInput horizontal" fileName="example.jpg" fileUrl="/img/example.jpg" accept="image/*" tooltip="Tooltip" />
			<RadioButtons horizontal label="RadioButtons horizontal" :options="radioButtonsOptions" v-model="radioButtonsTest" tooltip="Tooltip" />
			<NumberInput horizontal label="NumberInput horizontal" v-model="numberInputTest" tooltip="Tooltip" suffix="km" />
			<RangeInput horizontal label="RangeInput horizontal" v-model="rangeInputTest" tooltip="Tooltip" />
			<CheckboxGroup horizontal label="CheckboxGroup horizontal" :options="selectOptions" v-model="cbGroupTest" tooltip="Tooltip" />
			<RadioGroup horizontal label="RadioGroup horizontal" :options="selectOptions" v-model="radioGroupTest" tooltip="Tooltip" />
			<ToggleGroup horizontal label="ToggleGroup horizontal" :options="selectOptions" v-model="toggleGroupTest" tooltip="Tooltip" />
			<SimpleCheckbox horizontal label="SimpleCheckbox horizontal" v-model="cbTest" tooltip="Tooltip" />
			<SimpleToggle horizontal label="SimpleToggle horizontal" v-model="cbTest" tooltip="Tooltip" />
			<InputsRow horizontal label="InputsRow horizontal" tooltip="Tooltip">
				<RadioButtons :options="plusminus" v-model="plusminusTest" />
				<TextInput class="grow" v-model="textInputTest" placeholder="Placeholder" />
			</InputsRow>
			<TextareaInput horizontal label="TextareaInput horizontal" v-model="textareaTest1" tooltip="Tooltip" />
			<TextEditorInput horizontal label="TextEditorInput horizontal" simple v-model="textEditorTest" tooltip="Tooltip" />
		</Card>

	</AuthenticatedLayout>
</template>