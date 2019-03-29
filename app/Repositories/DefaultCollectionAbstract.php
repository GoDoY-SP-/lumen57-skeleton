<?php

namespace App\Repositories;


use App\Contracts\DefaultCollectionContract;

/**
 * Class DefaultCollectionAbstract
 * Coleção Abstrata Padrão
 * @package App\Repositories
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
abstract class DefaultCollectionAbstract implements DefaultCollectionContract
{
    /** @var  array */
    protected $collection;

    /**
     * Retornar a entidade da posição atual
     * @return object Entidade
     */
    public function current()
    {
        return current($this->collection);
    }

    /**
     * Retornar a chave da posição atual
     * @return int|string|null
     */
    public function key()
    {
        return key($this->collection);
    }

    /**
     * Retornar a entidade da próxima posição
     * @return mixed
     */
    public function next()
    {
        return next($this->collection);
    }

    /**
     * Voltar o ponteiro na primeira posição
     * @return mixed
     */
    public function rewind()
    {
        return reset($this->collection);
    }

    /**
     * Retornar a entidade da posição atual
     * @return bool
     */
    public function valid()
    {
        return isset($this->collection["{$this->key()}"]);
    }

    /**
     * Retornar a quantidade de posições da coleção
     * @return int
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * Converter os dados da coleção em array
     * @return array
     */
    public function toArray()
    {
        $arrayCollection = [];

        // Resetar coleção
        $this->rewind();
        while ($this->valid()) {
            $entidade = $this->current();
            $arrayCollection[] = $entidade->toArray();

            // Proxima entidade
            $this->next();
        }

        return $arrayCollection;
    }
}