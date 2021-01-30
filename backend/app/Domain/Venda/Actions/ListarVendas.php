<?php

namespace Domain\Venda\Actions;

use Support\Abstracts\Action\BaseAction;

class ListarVendas extends BaseAction
{
    public function bindRepository()
    {
        $this->repository = app('vendaRepository');
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