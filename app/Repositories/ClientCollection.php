<?php

namespace App\Repositories;


use App\Contracts\ClientCollectionContract;
use App\Contracts\ClientEntityContract;

/**
 * Class ClientCollection
 * Coleção de Clientes
 * @package App\Repositories
 * @autor Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientCollection extends DefaultCollectionAbstract implements ClientCollectionContract
{
    /**
     * Adicionar entidade na coleção
     * @param ClientEntityContract $entity
     * @return ClientCollectionContract
     */
    public function add($entity)
    {
        $this->collection["{$entity->getId()}"] = $entity;
        return $this;
    }

    /**
     * Remover entidade da coleção
     * @param ClientEntityContract $entity
     */
    public function remove($entity)
    {
        unset($this->collection["{$entity->getId()}"]);
    }
}