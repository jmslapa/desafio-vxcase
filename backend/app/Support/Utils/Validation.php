<?php

namespace Support\Utils;

class Validation
{
    /**
     * Transforma as strings "false", "true", "0" e "1" nos seus correspondentes booleanos, entretanto
     * caso o argumento não seja uma das strings especificadas, a função retorna o próprio argumento.
     *
     * @param string $value
     * @return mixed
     */
    static public function strToBool(string $value) {
        switch ($value) {
            case '':
                return false;
            case 'false':
                return false;
            case '0':
                return false;
            case 'true':
                return true;
            case '1':
                return true;
            default:
                return $value;
        }        
    }

    /**
     * Retorna um array com as regras de validação para a querystring com os parâmetros de filtragem
     *
     * @return array
     */
    static public function queryParamsValidationRules()
    {
        return [
            'filters' => ['nullable', 'string', 'regex:/^(\w+(\.\w+)?:[\w=><!]+:[a-zA-Zà-úÀ-Ú0-9%\/\-_\s@.]+,)*(\w+(\.\w+)?:[\w=><!]+:[a-zA-Zà-úÀ-Ú0-9%\/\-_\s@.]+)$/'],
            'orderBy' => ['nullable', 'string', 'regex:/^(\w+(\.\w+)?:(asc|desc),)*(\w+(\.\w+)?:(asc|desc))$/'],
            'page' => ['nullable', 'integer', 'min:1'],
            'perPage' => ['nullable', 'integer', 'min:1']
        ];
    }
}