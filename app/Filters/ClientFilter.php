<?php

namespace App\Filters;

use App\Contracts\ClientFilterContract;

/**
 * Class ClientFilter
 * Filtro de Cliente
 * @package App\Filters
 * @autor Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientFilter implements ClientFilterContract
{

    /**
     * Filtrar ID
     * @param integer $id
     * @return integer
     */
    public function filterId(int $id)
    {
        return preg_replace('/[^0-9]i/', '', $id);
    }

    /**
     * Filtrar Nome
     * @param string $name
     * @return string
     */
    public function filterName(string $name)
    {
        return trim(strtoupper($name));
    }

    /**
     * Filtrar E-mail
     * @param string $email
     * @return string
     */
    public function filterEmail(string $email)
    {
        return trim($email);
    }

    /**
     * Filtrar todos os atributos do cliente
     * @param array $client
     * @return array
     */
    public function filterAll(array $client)
    {
        foreach ($client as $key => $value) {
            switch ($key) {
                case 'id':
                    $client[$key] = $this->filterId($value);
                    break;
                case 'name':
                    $client[$key] = $this->filterName($value);
                    break;
                case 'email':
                    $client[$key] = $this->filterEmail($value);
                    break;
            }
        }

        return $client;
    }
}