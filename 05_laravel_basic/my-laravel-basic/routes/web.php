<?php
//　ファイル全体が純粋なPHPコードの場合、<?php の終了タグは省略可能

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\MyEnsureTokenIsValid;

use App\Http\Controllers\MyTaskController;

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
    Log::info('start welcome');
    return view('greeting', ['name' => 'James']);
    //return view('welcome');
});

Route::get('/greeting', function () {
    return '基本的なルーティングの確認';
});

// ルーターメソッドの優先順位は定義した順番

// 利用可能なルーターメソッド
// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);

// 複数のHTTP動詞への対応
// Route::match(['get', 'post'], '/', function () {
//     //
// });

// Route::any('/', function () {
//     //
// });

Route::post('/csrf', function (Request $request) {
    Log::info('csrfの確認');
    return 'csrfの確認';
});

Route::redirect('/here', '/greeting'); //return 302 リダイレクト
Route::redirect('/here302', '/greeting', 301); //return 301 Moved


// ルートがビューのみを返す場合は、Route::viewメソッド
Route::view('/test/welcome2', 'welcome');


// middlewareの利用 (app/http/Kernel.php)
Route::post('/mymddleware', function () {
    //
    Log::info('mymddleware start...'); 
    return 'mymddleware start';
})->middleware('mymddleware');
//直接Classの指定もできる
//})->middleware(MyEnsureTokenIsValid::class);

Route::get('/myreq', function( Request $request ){
    Log::info('myreq start...'); 
    Log::info($request);
    return 'myreq is working';
});

Route::get('/mytask', [MyTaskController::class, 'index']);
//Route::delete('/mytask', [MyTaskController::class, 'delete']);