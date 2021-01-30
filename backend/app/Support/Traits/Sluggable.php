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
    public function findBySlug(string $slug, $fail = true)
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

        static::saving(function($sluggable) {
            setlocale(LC_ALL, "en_US.utf8");
            $asciiAttribute = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $sluggable->getAttribute(static::getSluggableAttribute()));
            $sluggable->slug = Str::slug($asciiAttribute);
            if(($temp = $sluggable->findBySlug($sluggable->slug, false)) && $temp->id !== $sluggable->id) {
                throw new UnprocessableEntityHttpException('Já existe um produto com nome semelhante, realize alguma modificação.');
            }
        });
    }
}