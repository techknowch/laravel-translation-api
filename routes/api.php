<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;
use App\Http\Middleware\CheckApiKey;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api.key')->group(function () {

Route::get('translations/translate', [TranslationController::class, 'translate']);
Route::get('translations/search', [TranslationController::class, 'search']);
Route::get('translations/export', [TranslationController::class, 'export']);

Route::apiResource('languages', LanguageController::class);
Route::apiResource('translations', TranslationController::class);

});