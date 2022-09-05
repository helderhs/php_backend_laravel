<?php

namespace App\Http\Controllers;

use App\Models\Versiculo;
use Illuminate\Http\Request;
use App\Http\Resources\VersiculoResource;
use App\Http\Resources\VersiculoCollection;

class VersiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return new VersiculoCollection(Versiculo::select('id', 'capitulo', 'versiculo')->get());
        return new VersiculoCollection(Versiculo::select('id', 'capitulo', 'versiculo')->paginate(2));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Versiculo::create($request->all())) {
            return response()->json([
                'message' => ' Versiculo Cadastrado com sucesso.'
            ], 201);
        }

        return response()->json([
            'message' => ' Erro ao cadastrar o Versiculo.'
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
        $versiculo = Versiculo::find($id);

        if ($versiculo) {
            return new VersiculoCollection($versiculo);
            $response = [
                'resouce' => new VersiculoResource($versiculo),
            ];
            return $response;
        }

        return response()->json([
            'message' => ' Erro ao pesquisar o versiculo.'
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
        $id = Versiculo::find($id);
        if ($id) {
            $id->update($request->all());

            return $id;
        }

        return response()->json([
            'message' => ' Erro ao atualizar o Versiculo.'
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
        if (Versiculo::destroy($id)) {
            return response()->json([
                'message' => ' Versiculo deletado com sucesso.'
            ], 201);
        }

        return response()->json([
            'message' => ' Erro ao deletar o Versiculo.'
        ], 404);
    }
}
