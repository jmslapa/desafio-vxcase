<?php

namespace Application\Venda\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Venda extends JsonResource
{
    /**
     * Transforma o recurso recebido por parâmetro em um array
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}