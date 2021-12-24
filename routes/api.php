<?php

use App\Http\Controllers\AllNewsCont;
use App\Http\Controllers\ArabicCont;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\NewsCont;
use App\Http\Controllers\SourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::get('/welcome', function () {
//    $responseData['error'] = true;
//    $responseData['message'] = 'user has not been found';
//    return response()->json($responseData);
//});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("getAllNews/{lang}",[AllNewsCont::class,"getAllNews"]);
Route::get("displayNewsByID/{ID}",[ArticleController::class,"displayNewsByID"]);

Route::get("getArticlesByCategory/{category}",[ArabicCont::class,"getArticlesByCategory"]);

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);









// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post("storeNews",[ArticleController::class,"storeNews"]);
    Route::post("storeSource",[SourceController::class,"storeSource"]);
       Route::post('/logout', [AuthController::class, 'logout']);
});




