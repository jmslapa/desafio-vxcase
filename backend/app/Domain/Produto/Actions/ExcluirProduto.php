<?php

namespace Domain\Produto\Actions;

use Support\Abstracts\Action\BaseAction;

class ExcluirProduto extends BaseAction
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
    public function execute(string $slug)
    {
        dd("Excluir produto: $slug");
    }
}