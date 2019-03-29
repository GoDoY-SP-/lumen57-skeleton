<?php

namespace App\Repositories;


use App\Contracts\ClientEntityContract;

/**
 * Class ClientEntity
 * Entidade de Clientes
 * @package App\Repositories
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientEntity extends DefaultEntityAbstract implements ClientEntityContract
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ClientEntityContract
     */
    public function setId(int $id): ClientEntityContract
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ClientEntityContract
     */
    public function setName(string $name): ClientEntityContract
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return ClientEntityContract
     */
    public function setEmail(string $email): ClientEntityContract
    {
        $this->email = $email;
        return $this;
    }

}