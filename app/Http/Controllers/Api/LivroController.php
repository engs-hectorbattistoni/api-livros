<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LivroResource;
use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        return LivroResource::collection(Livro::latest()->paginate(10));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'autor' => ['required', 'string', 'max:255'],
            'ano_publicacao' => ['required', 'integer', 'min:1000', 'max:' . date('Y')],
            'isbn' => ['nullable', 'string', 'max:20', 'unique:livros,isbn'],
        ]);

        $livro = Livro::create($dados);

        return new LivroResource($livro);
    }

    public function show(Livro $livro)
    {
        return new LivroResource($livro);
    }

    public function update(Request $request, Livro $livro)
    {
        $dados = $request->validate([
            'titulo' => ['sometimes', 'string', 'max:255'],
            'autor' => ['sometimes', 'string', 'max:255'],
            'ano_publicacao' => ['sometimes', 'integer', 'min:1000', 'max:' . date('Y')],
            'isbn' => ['nullable', 'string', 'max:20', 'unique:livros,isbn,' . $livro->id],
        ]);

        $livro->update($dados);

        return new LivroResource($livro);
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();

        return response()->noContent();
    }
}
