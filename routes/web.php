<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WarehouseItemsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PageController;
// use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
// use Inertia\Inertia;

Route::middleware('auth')->group(function () {
	Route::get('/', [WarehouseItemsController::class, 'index'])->name('dashboard');

	Route::get('/warehouse', fn () => to_route('dashboard'));
	Route::post('/warehouse', [WarehouseItemsController::class, 'store'])->name('warehouseitem.store');

	Route::get('/warehouse/export', [WarehouseItemsController::class, 'exportAll'])->name('warehouse.export');
	Route::get('/warehouse/{warehouseItem}', [WarehouseItemsController::class, 'edit'])->name('warehouseitem.edit');
	Route::patch('/warehouse/{warehouseItem}', [WarehouseItemsController::class, 'update']);
	Route::delete('/warehouse/{warehouseItem}', [WarehouseItemsController::class, 'destroy']);

	Route::get('/warehouse/{warehouseItem}/export', [WarehouseItemsController::class, 'export'])->name('warehouseitem.export');
	Route::patch('/warehouse/{warehouseItem}/change', [WarehouseItemsController::class, 'change'])->name('warehouseitem.change');

	Route::get('/changes', [WarehouseItemsController::class, 'changes'])->name('warehousechanges');
	Route::patch('/changes/{warehouseChange}', [WarehouseItemsController::class, 'changeNote'])->name('warehousechange.note');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

	// component examples
	Route::get('/components', fn() => inertia('Components/Inputs'));
	Route::get('/components/buttons', fn() => inertia('Components/Buttons'));
	Route::get('/components/tables', fn() => inertia('Components/Tables'));
	Route::get('/components/modals', fn() => inertia('Components/Modals'));
	Route::get('/components/cards', fn() => inertia('Components/Cards'));
	Route::get('/components/other', fn() => inertia('Components/Other'));

	Route::middleware('isAdmin')->group(function () {
		Route::get('/users', [UsersController::class, 'index'])->name('users');
		Route::post('/users', [UsersController::class, 'store']);
		Route::get('/users/{user}', [UsersController::class, 'edit'])->name('user.edit');
		Route::patch('/users/{user}', [UsersController::class, 'update']);
		Route::delete('/users/{user}', [UsersController::class, 'destroy']);

		// admin routes + cache functions
		Route::prefix('admin')->group(function () {
			Route::get('/', fn() => inertia('Admin'));

			// upload image for text editor
			Route::post('/upimage', [PageController::class, 'uploadFile']);

			// config cache
			Route::get('/configClear', function() { echo Artisan::call('config:clear'); });
			Route::get('/configCache', function() { echo Artisan::call('config:cache'); });

			// route cache
			Route::get('/routeClear', function() { echo Artisan::call('route:clear'); });
			Route::get('/routeCache', function() { echo Artisan::call('route:cache'); });

			// views cache
			Route::get('/viewClear', function() { echo Artisan::call('view:clear'); });
			Route::get('/viewCache', function() { echo Artisan::call('view:cache');	});

			// link storage
			// Route::get('/linkStorage', function() { echo Artisan::call('storage:link'); });
		});
	});
});

require __DIR__.'/auth.php';
