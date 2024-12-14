<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\LessonsController;

Route::get('/', function () {
    return view('home');
});

Route::post('/space', [SpaceController::class, 'createPath']);
Route::get('/space',[SpaceController::class, 'library'] )->name('library');
Route::get("/space/lessons/delete/{id}", [SpaceController::class, 'delete']);

Route::get("/space/lessons/{id}", [LessonsController::class, 'lessons'])->name('lessons');
Route::post("/space/lessons/add-punishment/{id}", [LessonsController::class, 'punishment']);
Route::post("/space/lessons/done/{id}",[LessonsController::class, 'done']);

Route::get("/space/finished", [SpaceController::class, 'finished']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
