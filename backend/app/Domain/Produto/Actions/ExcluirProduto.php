<?php

namespace Domain\Produto\Actions;

use Illuminate\Support\Facades\DB;
use Support\Abstracts\Action\BaseAction;
use Support\Utils\Image;

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
        $produto = $this->repository->findBySlug($slug);
        $capa = $produto->capa;
        DB::transaction(function () use ($produto, $capa) {            
            $this->repository->delete($produto->id);
            if($capa) {
                Image::deleteIfExists($capa, 'public');
            }
        });
    }
}