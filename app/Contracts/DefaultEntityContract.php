<?php

namespace App\Contracts;

/**
 * Interface DefaultEntityContract
 * Contrato Padrão para Entidade
 * @package App\Contracts
 * @autor Danilo D. de Godoy <danilo.doring@gmail.com>
 */
interface DefaultEntityContract
{
    /**
     * Converter entidade para Array
     * @return array
     */
    public function toArray(): array;

    /**
     * Converter entidade para Json
     * @return false|string
     */
    public function toJson(): string;
}