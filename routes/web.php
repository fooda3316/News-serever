<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhonesCont;
use App\Http\Controllers\BuyCont;
use App\Http\Controllers\ChargeCont;
use App\Http\Controllers\PostCont;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SendBalanceCont;
use App\Http\Controllers\SendingShowCont;
use App\Http\Controllers\SendScratchCont;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/showNumbers/{id}', [PhonesCont::class, 'showNumbers']);
Route::get('/showNumbers/{id}', [PhonesCont::class, 'showNumbers']);
Route::get('/displaySellHistory/{userId}', [BuyCont::class, 'displaySellHistory']);

Route::get('/showProducts', [ProductController::class, 'showProducts']);

