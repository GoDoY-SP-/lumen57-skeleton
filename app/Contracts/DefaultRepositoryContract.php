<?php

namespace App\Contracts;

/**
 * Interface DefaultRepositoryContract
 * Contrato Padrão para Repositório
 * @package App\Contracts
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
interface DefaultRepositoryContract
{
    /**
     * Retornar todos os registros
     * @return array
     */
    public function findAll();

    /**
     * Retornar um registro pelo ID
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);
}