<?php

namespace Domain\Venda\Actions;

use Support\Abstracts\Action\BaseAction;

class ExibirVenda extends BaseAction
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
    public function execute(string $id)
    {
        return $this->repository->find($id);
    }
}