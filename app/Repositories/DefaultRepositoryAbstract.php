<?php

namespace App\Repositories;

use App\Contracts\DefaultRepositoryContract;

/**
 * Class DefaultRepositoryAbstract
 * Repositório Abstrato Padrão
 * @package App\Repositories
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
abstract class DefaultRepositoryAbstract implements DefaultRepositoryContract
{
    /** @var DefaultRepositoryContract */
    private $adapter;

    /**
     * DefaultRepositoryAbstract constructor.
     * @param DefaultRepositoryContract $adapter
     */
    public function __construct(DefaultRepositoryContract $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Retornar todos os registros
     * @return array
     */
    public function findAll()
    {
        return $this->adapter->findAll();
    }

    /**
     * Retornar um registro pelo ID
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->adapter->findById($id);
    }
}