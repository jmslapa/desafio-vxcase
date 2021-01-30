<?php

namespace Support\Contracts;

interface SluggableRepositoryContract
{
     /**
     * Realiza busca por um registro através do slug
     *
     * @param string $slug slug a ser pesquisado
     * @param boolean $fail se true, caso nenhum registro seja encotnrado, será lançada uma HttpNotFoundException
     * @return Model
     */
    public function findBySlug(string $slug, $fail = true);
}
