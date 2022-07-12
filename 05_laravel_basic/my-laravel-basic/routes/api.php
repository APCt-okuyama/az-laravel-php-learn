<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Log::info('start user');    
    return $request->user();
});

Route::get('/myapi', function (Request $request) {
    Log::info('start myapi');    
    return "my api start.";
});

// Route::get('/myapi', function () {
//     //
//     Log::info('my api start...'); 
//     return 'my api start';
// });