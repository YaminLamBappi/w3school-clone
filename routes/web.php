<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('public');
Route::get('/home/{slug}', [HomeController::class, 'home'])->name('home');
Route::get('/content/{slug}/{lslug}', [HomeController::class, 'content'])->name('home.content');






Route::get('/dashboard', function () {
    return view('layouts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/add/language', [LanguageController::class, 'create'])->name('AddLanguage');
    Route::post('/add/language', [LanguageController::class, 'store'])->name('store.language');
    Route::get('/all/language', [LanguageController::class, 'show'])->name('show.language');
    Route::post('/update/language/{slug}', [LanguageController::class, 'update'])->name('update.language');
    Route::get('/edit/language/{slug}', [LanguageController::class, 'edit'])->name('edit.language');
    Route::get('/language/{slug}', [LanguageController::class, 'destroy'])->name('destroy.language');


    Route::get('/add/topic', [TopicController::class, 'create'])->name('create.topic');
    Route::post('/add/topic', [TopicController::class, 'store'])->name('store.topic');
    Route::get('/all/topic', [TopicController::class, 'show'])->name('show.topic');
    Route::post('/update/topic/{slug}', [TopicController::class, 'update'])->name('update.topic');
    Route::get('/edit/topic/{slug}', [TopicController::class, 'edit'])->name('edit.topic');
    Route::get('/topic/{slug}', [TopicController::class, 'destroy'])->name('destroy.topic');


});

require __DIR__ . '/auth.php';
