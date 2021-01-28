<?php 

namespace Support\Utils;

use Illuminate\Contracts\Pagination\Paginator;

/**
 * Classe com métodos estáticos helpers para objeto de paginação.
 */
class Pagination {

    
    public static function makeVisible(Paginator $paginator, array $attributes) {

        $data = $paginator->getCollection()->each(function($item) use($attributes) {
            $item->makeVisible(...$attributes);
        });        
        $paginator->setCollection($data);

        return $paginator;
    }

    public static function load(Paginator $paginator, array $relations) {

        $data = $paginator->getCollection()->each(function($item) use($relations) {
            $item->load($relations);
        });        
        $paginator->setCollection($data);

        return $paginator;
    }

    public static function append(Paginator $paginator, array $attributes) {

        $data = $paginator->getCollection()->each(function($item) use($attributes) {
            $item->append($attributes);
        });        
        $paginator->setCollection($data);

        return $paginator;
    }
}
