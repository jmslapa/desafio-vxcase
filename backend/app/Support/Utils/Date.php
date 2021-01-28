<?php

namespace Support\Utils;

use Illuminate\Support\Carbon;

class Date
{
    /**
     * Recebe um array de dados e instancia um objeto Carbon a partir de todos os elementos que 
     * sejam stringDates e atendam ao formato estabelecido. Retorna um array com os valores
     * stringDate substituídos por seus objetos instanciados correspondentes.
     *
     * @param string $format
     * @param array $array
     * @return array
     */
    static public function instantiateFromFormat(string $format, array $array, string $timezone = null) : array
    {
        $data = array_map(function($element) use($format, $timezone) {
            try {
                $date = Carbon::createFromFormat($format, $element, $timezone);
                return $date;
            } catch(\Exception $e) {
                return $element;
            }
        }, $array);

        return $data;
    }
}