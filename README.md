# Skladnik

Simple Laravel website to track warehouse changes. App uses Laravel Breeze for authentication with Vue for UI and InertiaJS for communication.

I used same stack in other "apps", so the main purpose of this app is to make a **skeleton** for other apps. If you want to use this app in production, read the recommendations below.

App is based on **Laravel 11** and components uses **Vues 3.4** *defineModel* macro.

## Demo
Demo is available at [skladnik.pa2lo.net](https://skladnik.pa2lo.net)

login: ```demo@demo.demo```

password: ```demopassword```

Demo app contains **Components menu** with code examples of all Vue components available. More examples can be found in code itself.

## Highlights
- user roles, users management page available for admin and isAdmin middleware
- 30+ Vue components - UI, inputs, modals, dialogs, buttons, toasts...
- UI localization - commented lines in app.js
- admin routes with components and code examples (for local development)
- admin route with functions to clear cache and cache views, config and routes
- service worker and manifest file to allow installing website as PWA
- export data to XLS

## Development

First of all, install all dependencies:
```
composert install
npm install
```

Then make .env file and new key:
```
cp .env.example .env
php artisan key:generate
```

If you want to use SQLite, run:
```
touch database/database.sqlite
```
or set SQL connection in .env file.

Migrate DB:
```
php artisan migrate
```

Start local server:
```
php artisan serve
npm run dev
```

**First registered user** will get the **admin** role. Other users role is set to *user* by default. It is forbidden to edit user with ID 1 from *User accounts* page.

App supports image uploads within TinyMCE editor. To make upload work, you have to create symlink to storage folder by running command:
```
php artisan storage:link
```
or uncomment and visit admin/linkStorage route in routes/web.php. The destination is set by **uploadFile** function in *PageController*.

## Recommendations
If you want to use this app in production, I highly recommend to:
- set **REGISTRATION_ENABLED** variable in *.env* to false
- in production **remove components routes** from routes/web.php
- in production **remove components menu group** from resources/js/Layouts/AuthenticatedLayout.vue
- when building JS for production **delete Components folder** with component examples in resources/js/Pages

UI localization is available in sk.js file. To use localization you have to uncomment lines 10 and 11 in app.js file.

App supports export to XLS with rap2hpoutre/fast-excel package. If you dont need XLS support, remove *fast-excel* package from *composer.json*, delete *composer.lock* file and run:
```
composer install
composer dump-autoload
```

## Update 12/24
- added *downloadFile* helper function
- added *BasicColorInput* component
- added *IcoButtonCopy* component
- added *DeleteForm* composable
- added *BrowserStorage* composable
- added *input* type, *disabledRows* and *loadingRows* props to *dataTable*
- added *subtitle* prop to *AuthenticatedLayout*
- added *center* prop to tabs
- added *trim* prop to *TextInput*
- added *sameWidth* prop to *RadioButtons*
- added *hideButtons* prop to *NumberInput*
- added *circle* prop to *IcoButton*
- added *labelNote* prop to InputWrapper (all inputs)
- added *InfoTable* example page which uses d&d and composables
- updated *SelectInput* - added *searchPlaceholder, searchableFields, noItemsText, loading, searchThrottle* props and *search* event
- updated *WarehouseItemController* and related views to support *useDeleteForm* composable
- other bug fixes and improvements

## Update 9/24
- added *REGISTRATION_ENABLED* .env variable
- added *disabled* prop to *Dropdown*
- added *color* prop to *DropdownLink*
- added *solid* prop to *RadioButtons*
- added *showCount* prop to *SelectInput*
- added *setIndeterminate* exposed function to *SimpleCheckbox*
- added *modelDisabled, modelField* props and *v-model* to *DataTable*
- added *AppForms* composable
- added *AppInstaller* composable
- other bug fixes and improvements