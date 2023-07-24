<?php

use CmXperts\Menu\Http\Controllers\MenuController;

Route::group([
    'namespace' => 'CmXperts\Menu\Http\Controllers',
    'middleware' => config('menu.middleware'),
    'prefix' => config('menu.route_prefix'),
    'as' => 'cmxmenu.',
], function () {
    Route::get('/', function() {
        return view('cmxperts::menu.index');
    })->name('index');

    Route::post('add-item', [MenuController::class,'createItem'])->name('add-item');
    Route::post('delete-item', [MenuController::class,'destroyItem'])->name('delete-item');
    Route::post('update-item', [MenuController::class, 'updateItem'])->name('update-item');
    Route::post('create-menu', [MenuController::class, 'create'])->name('create-menu');
    Route::post('delete-menu', [MenuController::class, 'destroy'])->name('delete-menu');
    Route::post('update-menu-and-items', [MenuController::class, 'generateMenuControl'])->name('update-menu-and-items');
});
