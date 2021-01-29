<?php

namespace Application\Produto\Http\ResourceFactories;

use Support\Contracts\ResourceFactoryContract;

class ProdutoResourceFactory implements ResourceFactoryContract
{
    public function make($resource) {
        return app('produto', ['resource' => $resource]);
    }

    public function makeCollection($resource) {
        
        return app('produtoCollection', ['resource' => $resource]);
    }
}