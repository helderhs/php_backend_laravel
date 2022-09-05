<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VersiculoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'Testamento';

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'texto' => $this->texto,
            'tatamento' => 'texto tratado',
            //adicionando amarração
            'livros' => $this->livro,
            /*
            'links' => [
                [
                    'rel' => 'Alterar um versiculo',
                    'type' => 'PUT',
                    'link' => route('versiculo.update', $this->id)
                ],
                [
                    'rel' => 'Excluir um versiculo',
                    'type' => 'DELETE',
                    'link' => route('versiculo.destroy', $this->id)
                ]
            ]*/
        ];
    }
}
