<?php

namespace Application\Produto\Http\Validators;

use Support\Abstracts\Validator\BaseValidator;

class ProdutoValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();

        $this->customAttributes = [
            'preco' => 'preço',
            'entrega' => 'entrega (em dias)'
        ];

        $this->messages = [
            'preco.regex' => 'O campo preço deve ser um valor decimal com a representação obrigatória '
                            .'de 2 casas decimais separadas por vírgula e valor entre 0,00 e 99999999,99.',
        ];
    }

    protected function registerRules()
    {
        // Regras da action store
        $this->bind('store', [
            'nome' => ['required', 'string', 'between:3,50'],
            'preco' => ['required', 'regex:/^\d{1,8},\d{2}$/'],
            'entrega' => ['required', 'integer', 'between:0,255'],
        ]);

        // Regras da action update
        $this->bind('update', [
            'nome' => ['required', 'string', 'between:3,50'],
            'preco' => ['required', 'regex:/^\d{1,8},\d{2}$/'],
            'entrega' => ['required', 'integer', 'between:0,255'],
        ]);

        // Regras da action update
        $this->bind('uploadCapa', [
            'capa' => [
                'required',
                'image',
                'mimes:jpeg,png', 
                'dimensions:min_width=256,min_height=256,max_width=512,max_height=512,ratio=1/1',
                'max:2048',
            ],
        ]);
    }
}