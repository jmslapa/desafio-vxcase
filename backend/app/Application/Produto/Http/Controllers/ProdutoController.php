<?php

namespace Application\Produto\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Support\Abstracts\Controller\ApiController;

class ProdutoController extends ApiController
{
    public function bindActionsContainer()
    {
        $this->actions = app('produtoActionsContainer');
    }

    public function index(Request $request) 
    {
       try{
            $resource = $this->actions->listarProdutos();
            return $this->factory->makeCollection($resource)->toResponse(null);
        }catch(QueryException $e) {
            return $this->errorResponse($e, 500);
        }catch(ModelNotFoundException $e) {
            return $this->errorResponse($e, 404);
        }
    }

    public function show($identifier)
    {
        try{
            $resource = $this->actions->exibirProduto($identifier);
            return $this->factory->make($resource)->toResponse(null);
        }catch(QueryException $e) {
            return $this->errorResponse($e, 500);
        }catch(ModelNotFoundException $e) {
            return $this->errorResponse($e, 404);
        }
    }

    public function store(Request $request)
    {
        try{
            $data = $this->validator->validate('store', $request->all());
            $resource = $this->actions->cadastrarProduto($data);
            return $this->factory->make($resource)->toResponse(null, 201);
        }catch(QueryException $e) {
            return $this->errorResponse($e, 500);
        }catch(ModelNotFoundException $e) {
            return $this->errorResponse($e, 404);
        }
    }

    public function update(Request $request, $identifier)
    {
        try{
            // $data = $this->validator->validate('update', $request->all());
            // $resource = $this->actions->;
            // return response()->json(null, 202);
        }catch(QueryException $e) {
            return $this->errorResponse($e, 500);
        }catch(ModelNotFoundException $e) {
            return $this->errorResponse($e, 404);
        }
    }

    public function destroy($identifier)
    {
        try{
            $resource = $this->actions->excluirProduto($identifier);
            return response()->json(null, 204);
        }catch(QueryException $e) {
            return $this->errorResponse($e, 500);
        }catch(ModelNotFoundException $e) {
            return $this->errorResponse($e, 404);
        }
    }
}
