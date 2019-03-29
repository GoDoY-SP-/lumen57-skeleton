<?php

namespace App\Http\Services;

use App\Contracts\ClientCollectionContract;
use App\Contracts\ClientEntityContract;
use App\Contracts\ClientRepositoryContract;
use App\Contracts\ClientServiceContract;

/**
 * Class ClientService
 * Serviço de Cliente (Domain)
 * @package App\Http\Services
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientService implements ClientServiceContract
{
    /** @var ClientRepositoryContract */
    private $clientRepository;

    /**
     * ClientService constructor.
     * @param ClientRepositoryContract $clientRepository
     */
    public function __construct(
        ClientRepositoryContract $clientRepository
    )
    {

        $this->clientRepository = $clientRepository;
    }

    /**
     * Retornar todos os clientes
     * @return array | null
     */
    public function findAll(): array
    {
        /** @var ClientCollectionContract $clientCollection */
        $clientCollection = $this->clientRepository->findAll();
        return (!$clientCollection) ? null : $clientCollection->toArray();
    }

    /**
     * Retornar um cliente por ID
     * @param int $id
     * @return array | null
     */
    public function findById(int $id): array
    {
        /** @var ClientEntityContract $clientEntity */
        $clientEntity = $this->clientRepository->findById($id);
        return (!$clientEntity) ? null : $clientEntity->toArray();
    }
}