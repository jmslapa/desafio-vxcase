<?php

namespace Domain\Produto\Actions;

use Support\Abstracts\Action\BaseAction;

class ListarProdutos extends BaseAction
{
    public function bindRepository()
    {
        $this->repository = app('produtoRepository');
    }

    /**
     * Executa a ação 
     *
     * @return mixed
     */
    public function execute()
    {
        return $this->repository->findAll();
    }
}