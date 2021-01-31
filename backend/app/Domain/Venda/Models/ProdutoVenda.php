<?php

namespace Domain\Venda\Models;

use Domain\Produto\Models\Produto;
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
        'produto_id',
        'venda_id'
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
    protected $appends = [];

    protected static function booted()
    {
        parent::booted();

        static::creating(function($produtoVenda) {
            $produtoVenda->preco = $produtoVenda->produto->preco;
        });
    }

    /**
     * Mutator produto
     *
     * @return Model
     */
    public function getProdutoAttribute()
    {
        $produto = $this->produto()->first()->makeHidden('preco');
        $capa = $produto->capa;
        $produto->capa = $capa ? url("storage/$capa") : null;
        return $produto;
    }

    /**
     * Mutator venda
     *
     * @return Model
     */
    public function getVendaAttribute()
    {
        return $this->venda()->first()->makeHidden('criacao', 'atualizacao');
    }

    /**
     * Relacionamento com produto
     *
     * @return void
     */
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    /**
     * Relacionamento com venda
     *
     * @return void
     */
    public function venda()
    {
        return $this->belongsTo(Venda::class, 'venda_id');
    }
}