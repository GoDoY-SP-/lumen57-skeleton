<?php

namespace App\Filters;

use App\Contracts\ClientValidatorContract;
use Illuminate\Support\Facades\Validator;

/**
 * Class ClientValidator
 * Validador de Cliente
 * @package App\Filters
 * @autor Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientValidator implements ClientValidatorContract
{

    /**
     * Validar ID
     * @param integer $id
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateId(int $id)
    {
        $validator = Validator::make(
            [
                'id' => $id
            ],
            [
                'id' => 'required|integer'
            ]
        );

        return $validator;
    }

    /**
     * Validar Nome
     * @param string $name
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateName(string $name)
    {
        $validator = Validator::make(
            [
                'name' => $name,
            ],
            [
                'name' => 'required|alpha',
            ]
        );

        return $validator;
    }

    /**
     * Validar E-mail
     * @param string $email
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateEmail(string $email)
    {
        $validator = Validator::make(
            [
                'email' => $email,
            ],
            [
                'email' => 'required|email',
            ]
        );

        return $validator;
    }

    /**
     * Validar todos os atributos do cliente
     * @param array $client
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateAll(array $client)
    {
        $validator = Validator::make(
            $client,
            [
                'id' => 'required|integer',
                'name' => 'required|alpha',
                'email' => 'required|email',
            ]
        );

        return $validator;
    }
}