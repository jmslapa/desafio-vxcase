<?php

namespace Application\Venda\Http\Validators;

use Illuminate\Support\Arr;
use Support\Abstracts\Validator\BaseValidator;

class VendaValidator extends BaseValidator
{
    public function validate(string $ruleName, array $data)
    {
        $this->createDynamicArrayMessages($data);

        return parent::validate($ruleName, $data);
    }

    protected function registerRules()
    {
        // Regras da action store
        $this->bind('store', [
            'produtos' => ['required', 'array', 'min:1'],
            'produtos.*' => ['integer', 'min:1', 'exists:produto,id']
        ]);
    }

    /**
     * Cria mensagens dinâmicas para validações de campos array.
     *
     * @param array $data
     * @return void
     */
    private function createDynamicArrayMessages(array $data)
    {
        $messages = collect();

        if(Arr::has($data, 'produtos')) {
            $key = 0;             
            $messages->push(collect(Arr::get($data, 'produtos'))->reduce(function($carry, $current) use(&$key) {  
                $order = $key + 1;
                $carry["produtos.$key.integer"] = "O {$order}º identificador de produto da lista não é um número inteiro.";
                $carry["produtos.$key.min"] = "O {$order}º identificador de produto da lista não é um número inteiro maior que zero.";
                $carry["produtos.$key.exists"] = "O {$order}º identificador de produto da lista não é válido, pois o produto referenciado "
                                                .'não pôde ser encontrado.';
                $key++;
                return $carry;
            }, []));
        }

        $this->messages = $messages->collapse()->toArray();
    }
}