<?php

namespace Application\Produto\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Produto extends JsonResource
{
    /**
     * Transforma o recurso recebido por parâmetro em um array
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = parent::toArray($request);
        
        $capa = $resource['capa'] ?? null;
        $resource['capa'] = $capa ? url("storage/$capa") : null;
        
        return $resource;
    }
}