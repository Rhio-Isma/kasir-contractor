
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MaterialController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('categories', CategoryController::class)
    ->except(['show']);

Route::resource('units', UnitController::class)
    ->except(['show']);    

Route::resource('warehouses', WarehouseController::class)
    ->except(['show']);

Route::resource('projects', ProjectController::class)
    ->except(['show']);

Route::resource('materials', MaterialController::class)
    ->except(['show']);

