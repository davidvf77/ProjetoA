<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatesController;
use App\Http\Controllers\MetasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/entrar', function () {
    return view('entrar');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*ROTAS APENAS PARA USUÁRIOS AUTENTICADOS */


Route::middleware(['auth'])->group(function () {

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/metas/data/salvar', [DatesController::class, 'salvarData']);
Route::get('/metas/dashboard', [DatesController::class, 'dashboard']);

Route::get('/metas', [MetasController::class, 'index']);
Route::get('/metas/criar',[MetasController::class, 'criarMeta']);
Route::get('/metas/lista', [MetasController::class, 'listarMetas']);
Route::post('/metas/salvar', [MetasController::class, 'salvarMeta']);
Route::get('/metas/resetar', [MetasController::class, 'resetarMetas']);
Route::post('/metas/complete/{meta}', [MetasController::class, 'concluirMeta']);
Route::delete('/metas/delete/{meta}', [MetasController::class, 'deletarMeta']);

});


