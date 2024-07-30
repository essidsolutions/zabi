<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Quran\API\Chapter\ChapterController;
use App\Http\Controllers\Quran\API\Dhikr\DhikrController;
use App\Http\Controllers\Quran\API\Dua\DuaController;
use App\Http\Controllers\Quran\API\HaramCode\HaramCodeController;
use App\Http\Controllers\Quran\API\Juze\JuzesController;
use App\Http\Controllers\Quran\API\PrayerTime\PrayerTimeController;
use App\Http\Controllers\Quran\API\Settings\SettingsController;
use App\Http\Controllers\Quran\API\SifatName\SifatNameController;
use App\Http\Controllers\Quran\API\Translator\TranslatorController;
use App\Http\Controllers\Quran\API\Verse\VerseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('dashboard', [DashboardController::class, 'getDashboardInformation']);
Route::get('get-region-info', [DashboardController::class, 'getOsInfo']);
Route::get('get-country-info', [DashboardController::class, 'getCountryInfo']);
Route::get('chapters', [ChapterController::class, 'index']);
Route::get('verses/{chapter}', [VerseController::class, 'index']);
Route::get('juzes', [JuzesController::class, 'index']);
Route::get('translators', [TranslatorController::class, 'index']);
Route::get('dua-list', [DuaController::class, 'index']);
Route::get('dua-details/{id}', [DuaController::class, 'show']);
Route::get('dhikr-list', [DhikrController::class, 'dhikrList']);
Route::get('dhikr-details/{id}', [DhikrController::class, 'show']);
Route::get('sifat-name-list', [SifatNameController::class, 'dhikrList']);
Route::get('sifat-name-details/{id}', [SifatNameController::class, 'show']);
Route::get('haram-code-list', [HaramCodeController::class, 'haramCodeList']);
Route::get('today-prayer-time', [PrayerTimeController::class, 'todayPrayerTime']);
Route::get('settings', [SettingsController::class, 'index']);
