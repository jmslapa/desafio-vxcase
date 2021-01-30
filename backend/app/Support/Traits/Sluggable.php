<?php

namespace Support\Traits;

use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

trait Sluggable {

    /**
     * Retorna uma string contendo o nome do atributo a ser utilizado como base para a geração do
     *
     * @return string
     */
    abstract protected static function getSluggableAttribute() :string;    

    /**
     * Realiza busca por um registro através do slug
     *
     * @param string $slug
     * @param boolean $fail
     * @return Model
     */
    protected function findBySlug(string $slug, $fail = true)
    {
        $query = $this->query()->where('slug', $slug);
        return $fail ? $query->firstOrFail() : $query->first();
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();
        static::creating(function($produto) {
            setlocale(LC_ALL, "en_US.utf8");
            $asciiAttribute = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $produto->getAttribute(static::getSluggableAttribute()));
            $produto->slug = Str::slug($asciiAttribute);
            if($produto->findBySlug($produto->slug, false)) {
                throw new UnprocessableEntityHttpException('Já existe um produto com nome semelhante, realize alguma modificação.');
            }
        });
    }
}