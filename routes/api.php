<?php


use App\Http\Controllers\LivroController;
use App\Http\Controllers\TestamentoController;
use App\Http\Controllers\VersiculoController;
use App\Http\Controllers\AuthController;

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

Route::get('/teste', function () {
    return "FUNCIONOU";
});

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/testamento', [TestamentoController::class, 'index']);
    Route::get('/testamento/{id}', [TestamentoController::class, 'show']);
    Route::put('/testamento/{id}', [TestamentoController::class, 'update']);
    Route::post('/testamento', [TestamentoController::class, 'store']);
    Route::delete('/testamento/{id}', [TestamentoController::class, 'destroy']);

    Route::get('/livro', [LivroController::class, 'index']);
    Route::get('/livro/{id}', [LivroController::class, 'show']);
    Route::put('/livro/{id}', [LivroController::class, 'update']);
    Route::post('/livro', [LivroController::class, 'store']);
    Route::delete('/livro/{id}', [LivroController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->get('/versiculo', [VersiculoController::class, 'index']);
Route::middleware('auth:sanctum')->get('/versiculo/{id}', [VersiculoController::class, 'show']);
Route::middleware('auth:sanctum')->put('/versiculo/{id}', [VersiculoController::class, 'update']);
Route::middleware('auth:sanctum')->post('/versiculo', [VersiculoController::class, 'store']);
Route::middleware('auth:sanctum')->delete('/versiculo/{id}', [VersiculoController::class, 'destroy']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
