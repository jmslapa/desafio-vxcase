<?php

namespace Support\Traits;

use Illuminate\Support\Str;

trait Sluggable {

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();
        static::creating(function($produto) {
            $nome = iconv('UTF-8','ASCII//TRANSLIT', $produto->nome);
            $produto->nome = Str::slug($nome);
        });
    }

    protected function findBySlug($slug)
    {
        return $this->where('slug', $slug)->firstOrFail();
    }
}