<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\MyTaskController;

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

Route::get('/myapi2', function (Request $request) {
    Log::info('start myapi2');
    return ['message' => 'myapi2 is working.'];
});

Route::post('/myapi', function (Request $request) {
    Log::info('start myapi');
    Log::info($request);
    Log::info($request->input("name"));
    //var_dump($request);

    //contentがbody?
    $content = $request->getContent();
    Log::info($content);

    if ($request->expectsJson()) {
        Log::info("expectsJson is true");
    } else {
        Log::info("expectsJson is false");
    }

    $ipAddress = $request->ip();
    Log::info("ipAddress is $ipAddress");

    //JSONとして返す 下記２つは同じ
    // return response()->json([
    //     'message' => 'api is working.',
    //     Response::HTTP_OK
    // ]);
    return ['message' => 'api is working2.'];
});

// Route::get('/myapi', function () {
//     //
//     Log::info('my api start...'); 
//     return 'my api start';
// });

Route::post('/mytask', [MyTaskController::class, 'store']);