<?php

use App\Http\Controllers\DestinatarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/empresa/cadastrar', fn () => Inertia::render('EmpresaForm'))->name('empresa.create');
    Route::post('/empresa/cadastrar', [EmpresaController::class, 'store'])->name('empresa.store');
});

Route::middleware('auth')->prefix('destinatario')->group(function(){
        Route::get('/', [DestinatarioController::class,'index'])->name('destinatario.index');
        Route::get('/cadastrar', [DestinatarioController::class,'create'])->name('destinatario.create');
        ROUTE::post('/cadastrar', [DestinatarioController::class, 'store'])->name('destinatario.store');
    });

Route::middleware('auth')->prefix('produto')->group(function(){
    Route::get('/',[ProdutoController::class,'index'])->name('produto.index');
});


Route::post('/consulta-cep', [EmpresaController::class, 'consultarCep'])->middleware('auth');


require __DIR__.'/auth.php';
