<?php

namespace Application\Produto\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProdutoCollection extends ResourceCollection
{
    /**
     * Transforma a coleção de recursos recebida por parâmetro em array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}