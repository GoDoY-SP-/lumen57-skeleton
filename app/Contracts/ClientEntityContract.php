<?php

namespace App\Contracts;

/**
 * Interface ClientEntityContract
 * Contrato Padrão para Entidade de Cliente
 * @package App\Contracts
 * @autor Danilo D. de Godoy <danilo.doring@gmail.com>
 */
interface ClientEntityContract extends DefaultEntityContract
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return ClientEntityContract
     */
    public function setId(int $id): ClientEntityContract;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return ClientEntityContract
     */
    public function setName(string $name): ClientEntityContract;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     * @return ClientEntityContract
     */
    public function setEmail(string $email): ClientEntityContract;
}