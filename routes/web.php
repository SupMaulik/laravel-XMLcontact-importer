<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
 These routes handle the core contact management functions,
 including listing, creating, editing, deleting, and importing contacts.
*/

// Redirect base URL to contacts index page
Route::get('/', fn () => redirect()->route('contacts.index'));

//  Resource routes for full CRUD operations
Route::resource('contacts', ContactController::class);

// Show the form to import contacts from XML
Route::get('/contacts-import', [ContactController::class, 'importForm'])
    ->name('contacts.importForm');

//  Handle the import request and dispatch background job
Route::post('/contacts-import', [ContactController::class, 'import'])
    ->name('contacts.import');
