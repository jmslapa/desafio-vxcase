<?php

namespace Domain\Venda\Actions;

use Illuminate\Support\Facades\DB;
use Support\Abstracts\Action\BaseAction;

class EfetuarVenda extends BaseAction
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
    public function execute(array $data)
    {        
        $this->handleData($data);
        return DB::transaction(function () use($data) {
            $venda = $this->repository->save($data);
            $this->repository->syncProdutos($venda->id, $data['produtos']);
            return $venda;
        });
    }

    /**
     * Manipula informações do array de dados recebido
     *
     * @param array $data
     * @return void
     */
    private function handleData(array &$data)
    {
        $data['produtos'] = array_unique($data['produtos']);
    }
}