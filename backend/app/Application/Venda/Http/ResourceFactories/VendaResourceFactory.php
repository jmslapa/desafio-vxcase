<?php

namespace Application\Venda\Http\ResourceFactories;

use Support\Contracts\ResourceFactoryContract;

class VendaResourceFactory implements ResourceFactoryContract
{
    public function make($resource) {
        return app('venda', ['resource' => $resource]);
    }

    public function makeCollection($resource) {
        return app('vendaCollection', ['resource' => $resource]);
    }
}