<?php

namespace Domain\Venda\Models;

use Domain\Produto\Models\Produto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Support\Casts\DateCast;

class Venda extends Model
{
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
    protected $table = 'venda';
    
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
        'momento',
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
        'momento',
        'criacao',
        'atualizacao',
    ];
    
    /**
     * Atributos que são aptos à atribuição em massa
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * Atributos que serão ocultados por padrão.
     *
     * @var array
     */
    protected $hidden = [
        // 
    ];

    /**
     * Casts de propriedades
     *
     * @var array
     */
    protected $casts = [
        'momento' => DateCast::class.':America/Sao_Paulo,d/m/Y H:i:s',
        'criacao' => DateCast::class.':America/Sao_Paulo,d/m/Y H:i:s',
        'atualizacao' => DateCast::class.':America/Sao_Paulo,d/m/Y H:i:s',
    ];

    /**
     * Mutators a serem adicionados
     */
    protected $appends = ['items', 'subtotal', 'entrega_prevista'];

    protected static function booted()
    {
        parent::booted();

        static::creating(function($venda) {
            $venda->momento = now();
        });
    }

    /**
     * Mutator items
     *
     * @return Collection
     */
    public function getItemsAttribute()
    {
        return $this->produtos()->get()->map(function($p) {
            return $p->pivot->append('produto');
        });
    }
    
    /**
     * Mutator subtotal
     *
     * @return Collection
     */
    public function getSubtotalAttribute()
    {
        $subtotal = $this->items->reduce(function($acc, $curr) {
            $preco = (double) str_replace(',', '.', $curr->preco);
            return $acc + $preco;
        }, 0.00);

        return number_format($subtotal, 2, ',', '');
    }     
    
    /**
     * Mutator entrega prevista
     *
     * @return Collection
     */
    public function getEntregaPrevistaAttribute()
    {
        $entregaPrevista = $this->produtos()->get()->map(fn($p) => $p->entrega)
            ->sort(fn($a, $b) => $a - $b)
            ->reverse()
            ->first();
        return Carbon::createFromFormat('d/m/Y H:i:s', $this->momento, 'America/Sao_Paulo')
            ->addDays($entregaPrevista)
            ->format('d/m/Y');
    }

    /**
     * Relacionamento n:n com produto
     *
     * @return Collection
     */
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produto_venda', 'venda_id', 'produto_id')
                    ->using(ProdutoVenda::class)
                    ->withPivot(['preco']);
    }
}