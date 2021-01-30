<?php

namespace Domain\Venda\ActionsContainers;

class VendaActionsContainer
{
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
