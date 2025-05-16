<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testar-cep', [App\Http\Controllers\NuvemFiscalController::class, 'testarCep']);
