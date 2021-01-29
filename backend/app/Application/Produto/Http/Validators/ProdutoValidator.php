<?php

namespace Application\Produto\Http\Validators;

use Support\Abstracts\Validator\BaseValidator;

class ProdutoValidator extends BaseValidator
{
    protected function registerRules()
    {
        // Regras da action store
        $this->bind('store', [
            //
        ]);

        // Regras da action update
        $this->bind('update', [
            //
        ]);
    }
}