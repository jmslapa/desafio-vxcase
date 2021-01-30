<?php

namespace Support\Abstracts\Repository;

use Illuminate\Database\Eloquent\Model;
use Support\Contracts\RepositoryContract;
use Support\Utils\Date;

abstract class BaseRepository implements RepositoryContract
{
    /**
     * Instância do eloquent model de domínio
     */
    protected $model;
    
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findMany($ids)
    {
        return $this->model->findMany($ids);
    }

    public function save($dados)
    {
        return $this->model->create($dados);
    }

    public function update($id, $dados)
    {
        $model = $this->find($id);
        return $model->update($dados);
    }

    public function delete($id)
    {
        $model = $this->find($id);
        return $model->delete();
    }

    public function filter($filters, $orderBy, $perPage = null)
    {       
        $query = $this->model->query(); 

        foreach ($filters as [$field, $operator, $value]) {
            if($operator === 'between') {
                $query->whereBetween($field, $value);
                continue;
            }
            $query->where($field, $operator, $value);
        }

        foreach($orderBy as [$field, $sortType]) {
            $query->orderBy($field, $sortType);
        }

        return $perPage ? $query->paginate($perPage) : $query->get();
    }
}