<?php

use App\Http\Controllers\SubjectController;

// Apply the 'auth' middleware to routes that require authentication
Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/', function () {
        return view('dashboard.auth.login');
    });
    // Authentication routes
    Auth::routes();

    // Protected routes - requires authentication
    Route::group(['middleware' => ['auth']], function () {
        // Public routes
        Route::get('/', function () {
            return view('dashboard.homepage');
        });
        // Routes that require 'role:admin' middleware
        Route::group(['middleware' => ['role:admin']], function () {
            Route::resource('roles', 'RolesController');
            Route::get('/roles/move/move-up', 'RolesController@moveUp')->name('roles.up');
            Route::get('/roles/move/move-down', 'RolesController@moveDown')->name('roles.down');
            Route::resource('subjects', 'SubjectController');
            Route::resource('topics', 'TopicController');
            Route::get('/subjects/{id}/download-pdf', [SubjectController::class, 'downloadPDF'])->name('subjects.downloadPDF');
            Route::get('/subjects/{id}/download-html', [SubjectController::class, 'downloadHTML'])->name('subjects.downloadHTML');

            Route::prefix('menu/element')->group(function () {
                Route::get('/', 'MenuElementController@index')->name('menu.index');
                Route::get('/move-up', 'MenuElementController@moveUp')->name('menu.up');
                Route::get('/move-down', 'MenuElementController@moveDown')->name('menu.down');
                Route::get('/create', 'MenuElementController@create')->name('menu.create');
                Route::post('/store', 'MenuElementController@store')->name('menu.store');
                Route::get('/get-parents', 'MenuElementController@getParents');
                Route::get('/edit', 'MenuElementController@edit')->name('menu.edit');
                Route::post('/update', 'MenuElementController@update')->name('menu.update');
                Route::get('/show', 'MenuElementController@show')->name('menu.show');
                Route::get('/delete', 'MenuElementController@delete')->name('menu.delete');
            });

            Route::prefix('menu/menu')->group(function () {
                Route::get('/', 'MenuController@index')->name('menu.menu.index');
                Route::get('/create', 'MenuController@create')->name('menu.menu.create');
                Route::post('/store', 'MenuController@store')->name('menu.menu.store');
                Route::get('/edit', 'MenuController@edit')->name('menu.menu.edit');
                Route::post('/update', 'MenuController@update')->name('menu.menu.update');
                Route::get('/delete', 'MenuController@delete')->name('menu.menu.delete');
            });
        });
    });
});
