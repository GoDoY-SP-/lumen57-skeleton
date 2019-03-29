<?php

namespace App\Repositories;

use Zend\Hydrator\ClassMethodsHydrator;

/**
 * Class DefaultEntityAbstract
 * Entidade Abstrata Padrão
 * @package App\Repositories
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
abstract class DefaultEntityAbstract
{
    /**
     * Converter entidade para Array
     * @return array
     */
    public function toArray(): array
    {
        return (new ClassMethodsHydrator(false))->extract($this);
    }

    /**
     * Converter entidade para Json
     * @return false|string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}