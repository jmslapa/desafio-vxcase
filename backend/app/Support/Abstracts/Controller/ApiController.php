<?php

namespace Support\Abstracts\Controller;

use Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Support\Contracts\ResourceFactoryContract;
use Illuminate\Http\Response;
use Support\Abstracts\Validator\BaseValidator;

abstract class ApiController extends Controller
{
    /**
     * Container com as actions que implementam as regras de negócio.
     *
     * @var mixed
     */
    protected $actions;

    /**
     * Fábrica de Api Resources.
     *
     * @var Support\Contracts\ResourceFactoryContract
     */
    protected $factory;

    /**
     * Validador de dados recebidos por request.
     *
     * @var Support\Abstracts\Validator\BaseValidator
     */
    protected $validator;

    public function __construct(
        ResourceFactoryContract $factory,
        BaseValidator $validator
    ) {
        $this->factory = $factory;
        $this->validator = $validator;
        $this->boot();
    }

    /**
     * Executa ações iniciais no momento de instanciação do controller
     *
     * @return void
     */
    protected function boot()
    {
        $this->bindActionsContainer();
    }

    /**
     * Atribui à propriedade protegida $actions uma instância
     * de um ActionContainer.
     *
     * @return void
     */
    abstract public function bindActionsContainer(); 

    /**
     * Retorna uma todos os registros persistidos.
     *
     * @return Illuminate\Http\Response
     */
    abstract public function index(Request $request); 

    /**
     * Retorna um registro específico.
     *
     * @param mixed $identifier
     * @return Illuminate\Http\Response
     */
    abstract public function show($identifier);

    /**
     * Persiste um novo registro.
     *
     * @param Response $request
     * @return Illuminate\Http\Response
     */
    abstract public function store(Request $request);

    /**
     * Atualiza um registro específico.
     *
     * @param Response $request
     * @param mixed $identifier
     * @return Illuminate\Http\Response
     */
    abstract public function update(Request $request, $identifier);

    /**
     * Exclui um registro específico
     *
     * @param $identifier
     * @return Illuminate\Http\Response
     */
    abstract public function destroy($identifier);

    /**
     * Retorna uma resposta formatada para erros
     *
     * @param $tr implementação da interface Throwable
     * @return Illuminate\Http\Response
     */
    protected function errorResponse(\Throwable $tr, int $httpStatus, 
    $message = null) {

        if(env('APP_DEBUG', false)) {
            throw $tr;
        }

        switch ($httpStatus) {
            case 404:
                $message = $message ?? "O recurso solicidtado não foi encontrado.";
                break;
            
            default:
                $message = $message ?? "Não foi possível processar a solicitação. Tente novamente mais tarde.";
                break;
        }

        return response()->json([
            'message' => $message,
            'errors' => [get_class($tr)],
        ], $httpStatus);
    }
}