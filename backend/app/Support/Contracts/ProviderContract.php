<?php

namespace Support\Contracts;

interface ProviderContract
{
    /**
     * Registra as dependências das actions da entidade
     *
     * @return void
     */
    public function registerRepository();

    /**
     * Registra as dependências do repositório
     * 
     * @return void
     */
    public function registerRepositoryDependencies();

    /**
     * Registra os Api Resources.
     *
     * @return void
     */
    public function registerResources();

    /**
     * Registra as actions do contexto
     * 
     * @return void
     */
    public function registerActions();

    /**
     * Registra as dependências do Controller
     *
     * @return void
     */
    public function registerControllerDependencies();
}
