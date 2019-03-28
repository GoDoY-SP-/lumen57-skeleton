<?php

namespace App\Contracts;

/**
 * Interface ClientFilterContract
 * Contrato para Filtro de Cliente
 * @package App\Contracts
 * @autor Danilo D. de Godoy <danilo.doring@gmail.com>
 */
interface ClientFilterContract
{
    /**
     * Filtrar ID
     * @param integer $id
     * @return integer
     */
    public function filterId(int $id);

    /**
     * Filtrar Nome
     * @param string $name
     * @return string
     */
    public function filterName(string $name);

    /**
     * Filtrar E-mail
     * @param string $email
     * @return string
     */
    public function filterEmail(string $email);

    /**
     * Filtrar todos os atributos do cliente
     * @param array $client
     * @return array
     */
    public function filterAll(array $client);
}