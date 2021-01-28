<?php

namespace Support\Abstracts\Repository;

use Illuminate\Database\Eloquent\Model;
use Support\Contracts\RepositoryContract;
use Illuminate\Support\Str;
use Support\Utils\Date;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function find($identifier)
    {
        if(!Str::isUuid($identifier)) {
            throw new NotFoundHttpException('O recurso solicitado não existe ou está inacessível.');
        }
        return $this->model->where('uuid', '=', $identifier)->firstOrFail();
    }

    public function findMultiples($identifiers)
    {
        return $this->model->whereIn('uuid', $identifiers)->get();
    }

    public function save($dados)
    {
        return $this->model->create($dados)->refresh();
    }

    public function update($identifier, $dados)
    {
        $model = $this->find($identifier);
        return $model->update($dados);
    }

    public function delete($identifier)
    {
        $model = $this->find($identifier);
        return $model->delete();
    }

    public function filter($filters, $orderBy, $perPage = null)
    {       
        $query = $this->model->query(); 

        foreach ($filters as [$field, $operator, $value]) {
            if($operator === 'between') {
                $values = Date::instantiateFromFormat('d/m/Y', explode('__and__', $value));
                $query->whereBetween($field, $values);
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