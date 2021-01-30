<?php

namespace Domain\Venda\ActionsContainers;

class VendaActionsContainer
{
	/**
	 * Executa a ação ExibirVenda
	 *
	 * @return mixed
	 */
	public function exibirVenda(string $id)
	{
		return app('exibirVenda')->execute($id);
	}

	/**
	 * Executa a ação ListarVendas
	 *
	 * @return mixed
	 */
	public function listarVendas()
	{
		return app('listarVendas')->execute();
	}

	/**
	 * Executa a ação EfetuarVenda
	 *
	 * @return mixed
	 */
	public function efetuarVenda(array $data)
	{
		return app('efetuarVenda')->execute($data);
	}

    //
}
