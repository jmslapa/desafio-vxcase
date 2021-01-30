<?php

namespace Domain\Venda\Models;

use Illuminate\Database\Eloquent\Model;
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
        'id',
    ];

    /**
     * Casts de propriedades
     *
     * @var array
     */
    protected $casts = [
        'momento' => DateCast::class.':America/Sao_Paulo,d/m/Y H:i:s:',
        'criacao' => DateCast::class.':America/Sao_Paulo,d/m/Y H:i:s:',
        'atualizacao' => DateCast::class.':America/Sao_Paulo,d/m/Y H:i:s:',
    ];

    /**
     * Mutators a serem adicionados
     */
    protected $appends = [
        //
    ];
}