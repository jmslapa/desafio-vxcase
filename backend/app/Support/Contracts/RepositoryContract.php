<?php

namespace Support\Contracts;

interface RepositoryContract
{
     /**
     * Método que lista todos os registros encontrados na base de dados.
     * 
     * @return mixed
     */
     public function findAll();

     /**
     * Método que retorna todos registros atravez do identificador único
     * 
     * @param mixed $id identificador único
     * @return mixed
     */
     public function find($id);

     /**
     * Método que retorna todos registros atravez do identificador único
     * 
     * @param array $dados array associativo com dados a serem persistidos
     * @return mixed
     */
     public function save($dados);

     /**
      * Método que atualiza um registro no banco de dados atravez do 
      * identificador único
      *
      * @param mixed $id identificador único
      * @param array $dados array associativo com dados a serem persistidos
      * @return void
      */
     public function update($id, $dados);

     /**
     * Método que exclui um registro atravez do identificador único
     * 
     * @param mixed $id identificador único
     * @return void
     */
     public function delete($id);

     /**
     * Método que retorna o resultado de uma consulta ao banco de dados
     * mediante a aplicação de filtros
     * 
     * @param array $filters array associativo com filtros a serem aplicados
     * @return mixed
     */
     public function filter($filters, $order, $perPage = 15);
}
