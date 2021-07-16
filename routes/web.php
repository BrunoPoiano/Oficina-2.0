<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendedor\VendedorController;
use App\Http\Controllers\Orcamento\OrcamentoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('vendedor', VendedorController::class);
Route::resource('orcamento', OrcamentoController::class);

route::post('/pesquisar', [OrcamentoController::class, 'pesquisar'])->name('pesquisar');