<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use PHPUnit\Framework\Test;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Livro::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Livro::create($request->all())) {
            return response()->json([
                'message' => ' Livro Cadastrado com sucesso.'
            ], 201);
        }

        return response()->json([
            'message' => ' Erro ao cadastrar o livro.'
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livro = Livro::find($id);
        dd(Storage::disk('public')->url($livro->capa));
        if ($livro) {
            $response = [
                'livro' => $livro,
                'testamento' => $livro->testamento
            ];
            return $response;
        }

        return response()->json([
            'message' => ' Erro ao pesquisar o livro.'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $path = $request->capa->store('capa_livro', 'public');
        //dd('funcionou');

        $livro = Livro::find($id);

        if ($livro) {
            $livro->capa = $path;
            if ($livro->update($request->all())) {
                return $livro;
            }

            return response()->json([
                'message' => ' Erro ao atualizar o livro.'
            ], 404);
        }

        return response()->json([
            'message' => ' Erro ao atualizar o livro.'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Livro::destroy($id)) {
            return response()->json([
                'message' => ' Livro deletado com sucesso.'
            ], 201);
        }

        return response()->json([
            'message' => ' Erro ao deletar o livro.'
        ], 404);
    }
}
