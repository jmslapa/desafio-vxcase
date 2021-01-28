<?php

namespace Support\Abstracts\Validator;

use Illuminate\Support\Facades\Validator;

abstract class BaseValidator
{
    /**
     * Objeto que retém as rules em atributos com mesmo nome definido
     * na chamada do método bind.
     *
     * @var \stdClass
     */
    protected $rules;

    /**
     * Array de mensagens de erro personalizadas
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Array de nomes customizados para campos
     *
     * @var array
     */
    protected $customAttributes = [];

    /**
     * Retorna instância do Validator
     */
    public function __construct()
    {
        $this->rules = new \stdClass();
        $this->registerRules();
    }

    /**
     * Registra uma regra de validação.
     *
     * @param string $ruleName
     * @param array $rule
     * @return void
     */
    final protected function bind($ruleName, $rule)
    {
        $this->rules->$ruleName = $rule;
    }

    /**
     * Neste método deve-se declarar todas as rules a serem registradas
     * através de chamadas do método bind.
     *
     * @return void
     */
    abstract protected function registerRules();

    /**
     * Aplica uma regra de validação através do nome da regra, caso
     * tal regra exista, caso não, lança exception.
     *
     * @param string $ruleName
     * @param array $data
     * @return void
     */
    public function validate(string $ruleName, array $data)
    {
        if(!$this->rules->$ruleName){
            throw new \Exception('A regra requerida não existe.');
        }
        return Validator::make($data, $this->rules->$ruleName, $this->messages, $this->customAttributes)
                        ->validate();
    }

    
}