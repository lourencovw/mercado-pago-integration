<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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
Route::get('/credit-card', function () {
    return view('credit-card');
});
Route::get('/ticket', function () {
    return view('ticket');
});
Route::get('/thanks', function () {
    return view('thanks');
});

Route::post('/ticket', [PaymentController::class, 'ticket']);
