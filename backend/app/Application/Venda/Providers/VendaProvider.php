<?php

namespace Application\Venda\Providers;

use Application\Venda\Http\Controllers\VendaController;
use Application\Venda\Http\ResourceFactories\VendaResourceFactory;
use Application\Venda\Http\Resources\Venda as VendaResource;
use Application\Venda\Http\Resources\VendaCollection;
use Application\Venda\Http\Validators\VendaValidator;
use Domain\Venda\ActionsContainers\VendaActionsContainer;
use Domain\Venda\Models\Venda;
use Domain\Venda\Repositories\VendaRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Support\Abstracts\Validator\BaseValidator;
use Support\Contracts\ProviderContract;
use Support\Contracts\ResourceFactoryContract;

class VendaProvider extends ServiceProvider implements ProviderContract
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
        app()->bind('vendaRepository', VendaRepository::class);
    }

    /**
     * Registra as dependências do repositório
     * 
     * @return void
     */
    public function registerRepositoryDependencies()
    {
        $this->app->when(VendaRepository::class)
            ->needs(Model::class)
            ->give(Venda::class);
    }

    /**
     * Registra os Api Resources.
     *
     * @return void
     */
    public function registerResources()
    {
       app()->bind('venda', VendaResource::class);
       app()->bind('vendaCollection', VendaCollection::class);
    }

    /**
     * Registra as actions do context
     * 
     * @return void
     */
    public function registerActions()
    {
		app()->bind('efetuarVenda', \Domain\Venda\Actions\EfetuarVenda::class);
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
        app()->bind('vendaActionsContainer', VendaActionsContainer::class);
        
        // Validator
        $this->app->when(VendaController::class)
            ->needs(BaseValidator::class)
            ->give(VendaValidator::class);

        // Resource Factory
        $this->app->when(VendaController::class)
            ->needs(ResourceFactoryContract::class)
            ->give(VendaResourceFactory::class);
    }
}