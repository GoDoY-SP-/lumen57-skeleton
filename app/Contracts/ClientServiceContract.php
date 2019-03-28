<?php

namespace App\Contracts;

/**
 * Interface ClientServiceContract
 * Contrato para Serviço de Cliente
 * @package App\Contracts
 * @autor Danilo D. de Godoy <danilo.doring@gmail.com>
 */
interface ClientServiceContract
{
    /**
     * Retornar todos os clientes
     * @return array | null
     */
    public function findAll(): array;

    /**
     * Retornar um cliente por ID
     * @param int $id
     * @return array | null
     */
    public function findById(int $id): array;
}