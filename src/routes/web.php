<?php

use App\Http\Controllers\CollectionElementController;
use App\Http\Controllers\CollectionEntityController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\UserController;
use App\Livewire\CollectionElement\CreateCollectionElement;
use App\Livewire\CollectionElement\EditCollectionElement;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', [UserController::class, 'create'])->name('users.create');
Route::post('/register', [UserController::class, 'store'])->name('users.store');
Route::get('/login', [UserController::class, 'login'])->name('login');
route::post('/login', [UserController::class, 'auth'])->name('users.auth');

Route::middleware('auth')->group(function () {
    Route::get('/', [CollectionEntityController::class, 'index']);
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('users.update');
    Route::get('/change-password', [UserController::class, 'editPassword'])->name('users.edit_password');
    Route::patch('/change-password', [UserController::class, 'updatePassword'])->name('users.update_password');

    Route::resource('collections', CollectionEntityController::class);

    Route::resource('sources', SourceController::class);

    Route::prefix('/collections/{collection}')->group(function () {
        Route::get('/elements/create', CreateCollectionElement::class)->name('elements.create');
        Route::get('/elements/{element}/edit', EditCollectionElement::class)->name('elements.edit');
        Route::resource('elements', CollectionElementController::class)
            ->only(['show', 'destroy']);
    });
});

