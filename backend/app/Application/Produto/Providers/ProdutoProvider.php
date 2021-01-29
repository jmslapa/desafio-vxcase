<?php

namespace Application\Produto\Providers;

use Illuminate\Support\ServiceProvider;
use Support\Contracts\ProviderContract;

class ProdutoProvider extends ServiceProvider implements ProviderContract
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerControllerDependencies();
        $this->registerRepositoryDependencies();
        $this->registerRepository();
        $this->registerResources();
        $this->registerActions();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Registra a dependência das actions do contexto
     *
     * @return void
     */
    public function registerRepository()
    {
        //
    }

    /**
     * Registra as dependências do repositório
     * 
     * @return void
     */
    public function registerRepositoryDependencies()
    {
        //
    }

    /**
     * Registra os Api Resources.
     *
     * @return void
     */
    public function registerResources()
    {
       //
    }

    /**
     * Registra as actions do context
     * 
     * @return void
     */
    public function registerActions()
    {
        //
    }

    /**
     * Registra as dependências do Controller
     *
     * @return void
     */
    public function registerControllerDependencies()
    {
        // Actions Container        
        
        // Validator    

        // Resource Factory        
    }
}