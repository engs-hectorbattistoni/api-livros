<?php

use App\Http\Controllers\Api\LivroController;
use App\Http\Controllers\Api\PokemonController;
use Illuminate\Support\Facades\Route;

Route::apiResource('livros', LivroController::class);

Route::get('externo/pokemon/{nome}', [PokemonController::class, 'show']);
