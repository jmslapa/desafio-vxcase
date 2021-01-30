<?php

namespace Application\Produto\Providers;

use Application\Produto\Http\Controllers\ProdutoController;
use Application\Produto\Http\ResourceFactories\ProdutoResourceFactory;
use Application\Produto\Http\Resources\Produto as ProdutoResource;
use Application\Produto\Http\Resources\ProdutoCollection;
use Application\Produto\Http\Validators\ProdutoValidator;
use Domain\Produto\ActionsContainers\ProdutoActionsContainer;
use Domain\Produto\Models\Produto;
use Domain\Produto\Repositories\ProdutoRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Support\Abstracts\Validator\BaseValidator;
use Support\Contracts\ProviderContract;
use Support\Contracts\ResourceFactoryContract;

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
        app()->bind('produtoRepository', ProdutoRepository::class);
    }

    /**
     * Registra as dependências do repositório
     * 
     * @return void
     */
    public function registerRepositoryDependencies()
    {
        $this->app->when(ProdutoRepository::class)
            ->needs(Model::class)
            ->give(Produto::class);
    }

    /**
     * Registra os Api Resources.
     *
     * @return void
     */
    public function registerResources()
    {
       app()->bind('produto', ProdutoResource::class);
       app()->bind('produtoCollection', ProdutoCollection::class);
    }

    /**
     * Registra as actions do context
     * 
     * @return void
     */
    public function registerActions()
    {
		app()->bind('editarCapaProduto', \Domain\Produto\Actions\EditarCapaProduto::class);
		app()->bind('editarProduto', \Domain\Produto\Actions\EditarProduto::class);
		app()->bind('cadastrarProduto', \Domain\Produto\Actions\CadastrarProduto::class);
		app()->bind('excluirProduto', \Domain\Produto\Actions\ExcluirProduto::class);
		app()->bind('exibirProduto', \Domain\Produto\Actions\ExibirProduto::class);
		app()->bind('listarProdutos', \Domain\Produto\Actions\ListarProdutos::class);
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
        app()->bind('produtoActionsContainer', ProdutoActionsContainer::class);     
        
        // Validator    
        $this->app->when(ProdutoController::class)
            ->needs(BaseValidator::class)
            ->give(ProdutoValidator::class);

        // Resource Factory        
        $this->app->when(ProdutoController::class)
            ->needs(ResourceFactoryContract::class)
            ->give(ProdutoResourceFactory::class);
    }
}