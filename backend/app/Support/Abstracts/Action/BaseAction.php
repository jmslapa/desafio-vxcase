<?php

namespace Support\Abstracts\Action;

abstract class BaseAction
{
    /**
     * Repositório de acesso a dados da entidade
     *
     * @var Suppor\Respository\BaseRepository
     */
    protected $repository;

    /**
     * Retorna uma instância da action
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * Executa ações iniciais no momento de instanciação da action
     *
     * @return void
     */
    protected function boot()
    {
        $this->bindRepository();
    }

    /**
     * Atribui à propriedade protegida $repository uma instância
     * de um BaseRepository.
     *
     * @return void
     */
    abstract public function bindRepository(); 
}
