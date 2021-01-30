<?php

namespace Domain\Produto\ActionsContainers;

class ProdutoActionsContainer
{
	/**
	 * Executa a ação CadastrarProduto
	 *
	 * @return mixed
	 */
	public function cadastrarProduto(array $data)
	{
		return app('cadastrarProduto')->execute($data);
	}

	/**
	 * Executa a ação ExcluirProduto
	 *
	 * @return mixed
	 */
	public function excluirProduto(string $slug)
	{
		return app('excluirProduto')->execute($slug);
	}

	/**
	 * Executa a ação ExibirProduto
	 *
	 * @return mixed
	 */
	public function exibirProduto(string $slug)
	{
		return app('exibirProduto')->execute($slug);
	}

	/**
	 * Executa a ação ListarProdutos
	 *
	 * @return mixed
	 */
	public function listarProdutos()
	{
		return app('listarProdutos')->execute();
	}

    //
}
