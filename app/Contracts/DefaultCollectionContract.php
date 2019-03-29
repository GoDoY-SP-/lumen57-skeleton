<?php

namespace App\Contracts;

/**
 * Interface DefaultCollectionContract
 * Contrato Padrão para Coleção
 * @package App\Contracts
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
interface DefaultCollectionContract extends \Iterator
{
    /**
     * Contar a quantidade de itens da coleção
     * @return integer
     */
    public function count();

    /**
     * Adicionar entidade na coleção
     * @param $entity object
     * @return mixed
     */
    public function add($entity);

    /**
     * Remover entidade da coleção
     * @param $entity object
     * @return mixed
     */
    public function remove($entity);

    /**
     * Converter para array a coleção
     * @return array
     */
    public function toArray();
}