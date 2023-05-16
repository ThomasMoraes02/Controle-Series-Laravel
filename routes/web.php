<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodesController;

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

Route::get('/', function () {
    return view('welcome');
});

// Organizando por Controllers
// Route::controller(SeriesController::class)->group(function() {
//     Route::get("/series","index")->name("series.index");
//     Route::get("/series/criar","create")->name("series.create");
//     Route::post("/series/salvar","store")->name("series.store");
// });

// Utilizando Resourse
Route::resource("/series", SeriesController::class)->except('show');

Route::get("/series/{series}/seasons", [SeasonsController::class, 'index'])->name('seasons.index');

Route::get("/seasons/{season}/episodes", [EpisodesController::class, 'index'])->name('episodes.index');
Route::post("/seasons/{season}/episodes", [EpisodesController::class, 'update'])->name('episodes.update');