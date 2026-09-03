<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('home');
});

Route::resource('pessoas', PessoaController::class);