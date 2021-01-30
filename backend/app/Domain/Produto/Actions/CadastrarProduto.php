<?php

namespace Domain\Produto\Actions;

use Support\Abstracts\Action\BaseAction;

class CadastrarProduto extends BaseAction
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
    public function execute(array $data)
    {
        $this->handleData($data);
        return $this->repository->save($data);
    }

    /**
     * Manipula informações do array de dados recebido
     *
     * @param array $data
     * @return void
     */
    private function handleData(array &$data)
    {
        $data['preco'] = (double) str_replace(',', '.', $data['preco']);
    }
}