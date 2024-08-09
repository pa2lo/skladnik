<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import { txt } from '@/Utils/helpers'

import { useAppInstaller } from '@/Composables/AppInstaller'

import ApplicationLogo from '@/Components/Elements/ApplicationLogo.vue'
import Icon from '@/Components/Elements/Icon.vue'
import MenuGroup from '@/Components/Elements/MenuGroup.vue'
import MenuLink from '@/Components/Elements/MenuLink.vue'
import MobileMenuLink from '@/Components/Elements/MobileMenuLink.vue'
import Button from '@/Components/Elements/Button.vue'
import IcoButton from '@/Components/Elements/IcoButton.vue'

defineProps({
	header: String,
	headerMeta: String,
	backLink: String,
	width: {
		type: String,
		default: 'normal'
	}
})

const { installPrompt, installApp } = useAppInstaller()

let menuOpen = ref(false)
let isDark = ref(document.cookie.includes('theme=dark') || (window.matchMedia('(prefers-color-scheme: dark)').matches && !document.cookie.includes('theme=light')))

function switchTheme() {
	isDark.value = !isDark.value

	document.cookie = `theme=${isDark.value ? 'dark' : 'light'}; path=/`
	document.querySelector('meta[name="theme-color"]').setAttribute('content', isDark.value ? 'hsl(215, 71%, 6%)' : 'hsl(213, 39%, 95%)')
	window.darkTheme = isDark.value
	document.documentElement.classList.toggle('theme-dark', isDark.value)
	document.documentElement.classList.toggle('theme-light', !isDark.value)
}

const isDemo = ['skladnik.pa2lo.net', '127.0.0.1:8000'].includes(window.location.host)
const isiOS = /iPhone|iPad|iPod/.test(window.navigator?.userAgentData?.platform || window.navigator.platform)
</script>

<template>
	<Head :title="headerMeta ?? header" />
	<aside class="sidemenu-cont" :class="{menuOpen: menuOpen}">
		<div class="sidemenu-backdrop l-hide clickable" @click="menuOpen = !menuOpen"></div>
		<nav class="sidemenu-menu flex">
			<div class="sidemenu-logo flex ai-c">
				<ApplicationLogo />
				<Icon class="sidemenu-hide-x clickable ml-a l-hide" name="x" @click="menuOpen = !menuOpen" />
			</div>
			<div class="divided">
				<MenuLink link="/" activeRoute="/warehouse" icon="boxes">{{ txt('Warehouse') }}</MenuLink>
				<MenuLink link="/changes" icon="history">{{ txt('List of changes') }}</MenuLink>
			</div>
			<div class="line divided" :class="{'mb-a': !installPrompt && !isDemo}">
				<MenuLink v-if="$page.props?.auth?.user?.role == 'admin'" activeRoute="/users" link="/users" icon="users">{{ txt('User accounts') }}</MenuLink>
				<MenuLink link="/profile" icon="user-edit">{{ txt('Profile') }}</MenuLink>
			</div>
			<div v-if="isDemo || installPrompt" class="line divided mb-a">
				<MenuGroup v-if="isDemo" :title="txt('Components')" icon="components" :active="['/components']">
					<MenuLink link="/components">{{ txt('Inputs') }}</MenuLink>
					<MenuLink link="/components/buttons">{{ txt('Buttons') }}</MenuLink>
					<MenuLink link="/components/tables">{{ txt('Data table') }}</MenuLink>
					<MenuLink link="/components/modals">{{ txt('Modals, toasts, alerts') }}</MenuLink>
					<MenuLink link="/components/cards">{{ txt('Cards, tabs, widgets') }}</MenuLink>
					<MenuLink link="/components/other">{{ txt('Tooltips, other') }}</MenuLink>
				</MenuGroup>
				<MenuLink v-if="installPrompt" isButton icon="download" @click.prevent="installApp">{{ txt('Download app') }}</MenuLink>
				<MenuLink v-if="isDemo" link="https://github.com/pa2lo/skladnik" icon="github" external>GitHub</MenuLink>
			</div>
			<div class="line divided sidemenu-footer flex ai-c">
				<Button color="heading" size="compact" variant="outline" :icon="isDark ? 'sun' : 'moon'" bigIcon :title="isDark ? 'Light mode' : 'Dark mode'" @click="switchTheme" />
				<Button color="link" size="compact" variant="outline" class="grow" link="/logout" icon="logout" method="post" as="button">{{ txt('Log Out') }}</Button>
			</div>
		</nav>
	</aside>
	<div class="authenticated-layout" :class="[`authenticated-layout-${width}`]" :tabindex="isiOS ? '-1' : null">
		<header class="authenticated-header flex ai-c">
			<IcoButton v-if="backLink" icon="left" class="authenticated-header-back" :link="backLink" transparent />
			<h1 class="page-title">{{ header ?? $page.component }}</h1>
			<button class="menu-toggler flex aj-c clickable l-hide" @click="menuOpen = !menuOpen"><Icon name="menu" /></button>
		</header>
		<main class="page-main section">
			<div class="page-content">
				<slot />
			</div>
		</main>
		<aside class="mobile-nav flex l-hide">
			<MobileMenuLink link="/" icon="boxes">{{ txt('Warehouse') }}</MobileMenuLink>
			<MobileMenuLink link="/changes" icon="history">{{ txt('Changes') }}</MobileMenuLink>
			<MobileMenuLink v-if="$page.props?.auth?.user?.role == 'admin'" activeRoute="/users" link="/users" icon="users">{{ txt('Accounts') }}</MobileMenuLink>
		</aside>
	</div>
</template>