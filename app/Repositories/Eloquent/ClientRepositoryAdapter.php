<?php

namespace App\Repositories\Eloquent;

use App\Contracts\ClientCollectionContract;
use App\Contracts\ClientEntityContract;
use App\Contracts\ClientRepositoryContract;
use Zend\Hydrator\ClassMethodsHydrator;

/**
 * Class ClientRepositoryAdapter
 * Adaptador de Repositório usando Eloquent
 * @package App\Repositories\Eloquent
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientRepositoryAdapter implements ClientRepositoryContract
{
    /** @var ClientModel */
    private $model;

    /** @var ClientEntityContract */
    private $clientEntity;

    /** @var ClientCollectionContract */
    private $clientCollection;

    /**
     * ClientModel constructor.
     * @param ClientModel $model
     * @param ClientEntityContract $clientEntity
     * @param ClientCollectionContract $clientCollection
     */
    public function __construct(
        ClientModel $model,
        ClientEntityContract $clientEntity,
        ClientCollectionContract $clientCollection
    )
    {
        $this->model = $model;
        $this->clientEntity = $clientEntity;
        $this->clientCollection = $clientCollection;
    }

    /**
     * Retornar todos os registros
     * @return ClientCollectionContract
     */
    public function findAll()
    {
        // Chamada do eloquent
        /** @var ClientModel[]|\Illuminate\Database\Eloquent\Collection $eloquentCollection */
        $eloquentCollection = $this->model->all();

        if (!$eloquentCollection) {
            return null;
        }

        /** @var ClientEntityContract | null $clientEntity */
        $clientEntity = clone $this->clientEntity;

        /** @var ClientCollectionContract $clientCollection */
        $clientCollection = clone $this->clientCollection;

        foreach ($eloquentCollection as $eloquentModel) {
            /** @var \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null $eloquentModel */
            /** @var ClientEntityContract | null $clientEntity */
            $clientEntity = (new ClassMethodsHydrator(false))->hydrate(
                $eloquentModel->toArray(),
                $clientEntity
            );

            $clientCollection->add($clientEntity);
        }

        return $clientCollection;
    }

    /**
     * Retornar um registro pelo ID
     * @param int $id
     * @return ClientEntityContract | null
     */
    public function findById(int $id)
    {
        /** @var \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null $eloquentModel */
        $eloquentModel = $this->model->newQuery()->find($id);

        if (!$eloquentModel) {
            return null;
        }

        /** @var ClientEntityContract | null $clientEntity */
        $clientEntity = clone $this->clientEntity;
        $clientEntity = (new ClassMethodsHydrator(false))->hydrate(
            $eloquentModel->toArray(),
            $clientEntity
        );

        return $clientEntity;
    }
}