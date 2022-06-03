<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');


Route::post('custom-add-event', [EventsController::class, 'customAddEvent'])->name('add.event');
Route::get('customEventSearch', [EventsController::class, 'customEventSearch'])->name('events.search');
Route::post('customEventSearch', [EventsController::class, 'customEventSearch'])->name('events.search');
Route::get('addevents', [EventsController::class, 'addEvents'])->name('addevents');
Route::get('pre-events', [EventsController::class, 'preLoginEvents'])->name('pre-events');
Route::get('events-list', [EventsController::class, 'Events'])->name('events-list');