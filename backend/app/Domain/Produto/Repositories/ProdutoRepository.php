<?php

namespace Domain\Produto\Repositories;

use Support\Abstracts\Repository\BaseRepository;
use Support\Contracts\SluggableRepositoryContract;

class ProdutoRepository extends BaseRepository implements SluggableRepositoryContract
{
    public function findBySlug(string $slug, $fail = true)
    {
        return $this->model->findBySlug($slug, $fail);
    }
}