<?php

namespace Domain\Venda\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Support\Casts\PrecoCast;

class ProdutoVenda extends Pivot
{
    /**
     * Nome da tabela que representa o model no banco de dados
     *
     * @var mixed
     */
    protected $table = 'produto_venda';
    
    /**
     * Determina se os campos timestamp existirão
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Definição do formato dos campos data
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * Atributos que não são aptos à atribuição em massa
     *
     * @var array
     */
    protected $guarded = [
        'produto_id',
        'venda_id',
    ];
    
    /**
     * Atributos que são aptos à atribuição em massa
     *
     * @var array
     */
    protected $fillable = [
        'preco'
    ];

    /**
     * Atributos que serão ocultados por padrão.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    /**
     * Casts de propriedades
     *
     * @var array
     */
    protected $casts = [
        'preco' => PrecoCast::class
    ];

    /**
     * Mutators a serem adicionados
     */
    protected $appends = [
        //
    ];
}