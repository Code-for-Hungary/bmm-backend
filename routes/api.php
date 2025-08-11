<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventgeneratorController;
use App\Http\Controllers\SubscriptionController;
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

Route::get('/eventgenerators', [EventgeneratorController::class, 'index']);
Route::get('/eventgenerators/{eventgenerator}', [EventgeneratorController::class, 'show']);
Route::post('/eventgenerators', [EventgeneratorController::class, 'store'])->middleware('api.key');

Route::post('/subscriptions', [SubscriptionController::class, 'store']);
Route::post('/subscriptions/confirm/{subscription}', [SubscriptionController::class, 'confirm'])->name('confirmation');
Route::post('/subscriptions/unsubscribe/{subscription}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');
Route::post('/subscriptions/manage', [SubscriptionController::class, 'manage']);

Route::get('/events/bygenerator/{eventgenerator}', [EventController::class, 'indexByGenerator'])->middleware('eventgenerator.api.key');
Route::post('/events/notify/{event}', [EventController::class, 'notify'])->middleware('eventgenerator.api.key');
