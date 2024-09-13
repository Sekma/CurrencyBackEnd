<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PairController;

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

// partie admin

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('logout', [AuthController::class, 'logout']);

// partie utilisateur

//savoir si le service est fonctionnel
Route::get('currencies', [CurrencyController::class, 'index']);

//créer une nouvelle devise
Route::post('create_currency', [CurrencyController::class, 'store']);

//modifier une devise
Route::put('edit_currency/{id}', [CurrencyController::class, 'update']);

//supprimer une devise
Route::delete('delete_currency/{id}', [CurrencyController::class, 'destroy']);

//récupérer la liste des pairs de conversion supportées
Route::get('pairs', [PairController::class, 'index'])->name('pair');

//convertir une quantité de devise suivant une paire existante
Route::get('/convert/{id}/{value}', [PairController::class, 'convert']);

//créer un nouveau pair
Route::post('create_pair', [PairController::class, 'store']);

//modifier un pair
Route::put('edit_pair/{id}', [PairController::class, 'update']);

//supprimer un pair
Route::delete('delete_pair/{id}', [PairController::class, 'destroy']);