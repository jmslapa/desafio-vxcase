<?php

namespace Support\Contracts;

interface ResourceFactoryContract
{
    /**
     * Retorna uma instância de um JsonResource.
     *
     * @param mixed $resource
     * @return Illuminate\Http\Resources\Json\JsonResource
     */
    public function make($resource);

    /**
     * Retorna uma instância de um ResourceCollection.
     *
     * @param mixed $resource
     * @return Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function makeCollection($resource);
}