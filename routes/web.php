<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('home');
});

Route::get('/cadastro', function(){
    return Inertia::render('cadastro');
})->name('cadastro');

Route::post('/cadastro_store', [PessoaController::class,'store']);