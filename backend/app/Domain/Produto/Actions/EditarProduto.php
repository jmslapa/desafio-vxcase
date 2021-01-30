<?php

namespace Domain\Produto\Actions;

use Support\Abstracts\Action\BaseAction;

class EditarProduto extends BaseAction
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
    public function execute(string $slug, array $data)
    {
        $this->handleData($data);
        $produto = $this->repository->findBySlug($slug);
        $this->repository->update($produto->id, $data);
        return $produto->refresh();
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