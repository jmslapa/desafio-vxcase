<?php

namespace Domain\Venda\Repositories;

use Support\Abstracts\Repository\BaseRepository;

class VendaRepository extends BaseRepository
{
    /**
     * Recebe um id de uma venda e um array de intancias ou ids de produtos e realiza a sincronização 
     * dos relacionamentos entre os produtos e a venda
     *
     * @param int $id
     * @param iterable $produtos
     * @return void
     */
    public function syncProdutos($id, iterable $produtos)
    {
        $venda = $this->find($id);
        $venda->produtos()->sync($produtos);
    }
}