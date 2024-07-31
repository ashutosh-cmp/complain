<?php

use App\Http\Controllers\SubjectController;

Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/', function () {
        return view('dashboard.homepage');
    });

    Auth::routes();

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('subjects', 'SubjectController');
        Route::resource('topics', 'TopicController');
        Route::get('/subjects/{id}/download-pdf', [SubjectController::class, 'downloadPDF'])->name('subjects.downloadPDF');
        Route::get('/subjects/{id}/download-html', [SubjectController::class, 'downloadHTML'])->name('subjects.downloadHTML');
    });
});
