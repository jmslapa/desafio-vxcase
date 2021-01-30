<?php

namespace Domain\Produto\Actions;

use Illuminate\Support\Facades\DB;
use Support\Abstracts\Action\BaseAction;
use Support\Utils\Image;

class RemoverCapaProduto extends BaseAction
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
        DB::transaction(function ()  use($slug) {
            $produto = $this->repository->findBySlug($slug);
            $capa = $produto->capa;
            $this->repository->update($produto->id, ['capa' => null]);
            Image::deleteIfExists($capa, 'public');
        });
    }
}