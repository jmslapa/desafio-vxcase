<?php

namespace Domain\Produto\ActionsContainers;

class ProdutoActionsContainer
{
	/**
	 * Executa a ação EditarCapaProduto
	 *
	 * @return mixed
	 */
	public function editarCapaProduto(string $slug, array $data)
	{
		return app('editarCapaProduto')->execute($slug, $data);
	}

	/**
	 * Executa a ação EditarProduto
	 *
	 * @return mixed
	 */
	public function editarProduto(string $slug, array $data)
	{
		return app('editarProduto')->execute($slug, $data);
	}

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
