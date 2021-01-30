<?php

namespace Domain\Produto\Actions;

use Support\Abstracts\Action\BaseAction;
use Support\Utils\Image;

class EditarCapaProduto extends BaseAction
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
        try {
            $this->handleData($data);
            $produto = $this->repository->findBySlug($slug);
            $capaAtual = $produto->capa;
            $this->repository->update($produto->id, $data);
            if($capaAtual) {
                Image::deleteIfExists($capaAtual, 'public');
            }
            return $produto->refresh();
        } catch (\Throwable $th) {
            if($data['capa']) {
                Image::deleteIfExists($data['capa'], 'public');
            }
            throw $th;
        }
    }

    /**
     * Manipula informações do array de dados recebido
     *
     * @param array $data
     * @return void
     */
    private function handleData(array &$data)
    {
        $image = $data['capa'];
        $data['capa'] = Image::store('produtos', 'public', $image);
    }
}