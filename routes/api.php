<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('languages', LanguageController::class);
Route::apiResource('translations', TranslationController::class);
Route::get('translations/search', [TranslationController::class, 'search']);
Route::get('translations/export', [TranslationController::class, 'export']);