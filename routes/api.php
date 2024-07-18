<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\akadControllerSiam;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Models\Emsmhs;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('index', [App\Http\Controllers\akadControllerSiam::class,'index']);

Route::get('test', function() {
    $user = Emsmhs::find(123123123);
    $user->createToken('MyApp')->accessToken;
});

Route::post('register', [RegisterController::class, 'register']);

Route::post('loginn', [RegisterController::class, 'loginn']);

     Route::resource('products', ProductController::class);

Route::middleware('auth:api')->group( function () {


    Route::post('details', [RegisterController::class, 'details']);

    Route::post('logout', [RegisterController::class, 'logout']);
    

});