<?php

namespace Domain\Produto\Models;

use Domain\Venda\Models\ProdutoVenda;
use Domain\Venda\Models\Venda;
use Illuminate\Database\Eloquent\Model;
use Support\Casts\DateCast;
use Support\Casts\PrecoCast;
use Support\Traits\Sluggable;

class Produto extends Model
{
    use Sluggable;

    /**
     * Retorna uma string contendo o nome do atributo a ser utilizado como base para a geração do
     *
     * @return string
     */
    protected static function getSluggableAttribute() :string
    {
        return 'nome';
    }

    /**
     * Nome do campo que utilizado como primary key
     *
     * @var mixed
     */
    protected $primaryKey = 'id';

    /**
     * Nome da tabela que representa o model no banco de dados
     *
     * @var mixed
     */
    protected $table = 'produto';
    
    /**
     * Definição do nome do campo timestamp de criação
     */
    const CREATED_AT = 'criacao';

    /**
     * Definição do nome do campo timestamp de atualização
     */
    const UPDATED_AT = 'atualizacao';

    /**
     * Definição dos campos que são datas
     */
    protected $dates = [
        'criacao',
        'atualizacao',
    ];

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
        'id',
        'slug',
        'criacao',
        'atualizacao',
    ];
    
    /**
     * Atributos que são aptos à atribuição em massa
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'preco',
        'entrega',
        'capa'
    ];

    /**
     * Atributos que serão ocultados por padrão.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    /**
     * Casts de propriedades
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'preco' => PrecoCast::class,
        'criacao' => DateCast::class.':America/Sao_Paulo,d/m/Y H:i:s:',
        'atualizacao' => DateCast::class.':America/Sao_Paulo,d/m/Y H:i:s:',
    ];

    /**
     * Mutators a serem adicionados
     */
    protected $appends = [
        //
    ];

    /**
     * Relacionamento n:n com venda
     *
     * @return Collection
     */
    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'venda', 'produto_id', 'venda_id')
                    ->using(ProdutoVenda::class)
                    ->withPivot(['preco']);
    }
}