<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function show(string $nome)
    {
        try {
            $resposta = Http::timeout(10)->get('https://pokeapi.co/api/v2/pokemon/' . strtolower($nome));
        } catch (ConnectionException $e) {
            return response()->json(['erro' => 'Não foi possível acessar a PokéAPI'], 502);
        }

        if ($resposta->failed()) {
            return response()->json(['erro' => 'Pokémon não encontrado'], 404);
        }

        $dados = $resposta->json();

        return response()->json([
            'id' => $dados['id'],
            'nome' => $dados['name'],
            'altura' => $dados['height'],
            'peso' => $dados['weight'],
            'tipos' => collect($dados['types'])->pluck('type.name'),
            'imagem' => $dados['sprites']['front_default'],
        ]);
    }
}
