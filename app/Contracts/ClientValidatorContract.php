<?php

namespace App\Contracts;

/**
 * Interface ClientValidatorContract
 * Contrato para Validação de Cliente
 * @package App\Contracts
 * @autor Danilo D. de Godoy <danilo.doring@gmail.com>
 */
interface ClientValidatorContract
{
    /**
     * Validar ID
     * @param integer $id
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateId(int $id);

    /**
     * Validar Nome
     * @param string $name
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateName(string $name);

    /**
     * Validar E-mail
     * @param string $email
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateEmail(string $email);

    /**
     * Validar todos os atributos do cliente
     * @param array $client
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateAll(array $client);
}