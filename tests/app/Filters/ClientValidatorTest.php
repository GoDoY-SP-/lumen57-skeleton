<?php

namespace AppTest\Filters;

use App\Filters\ClientValidator;
use Illuminate\Contracts\Validation\Validator;
use PHPUnit\Framework\TestCase;

/**
 * Teste Unitário da Classe ClientValidator
 * Class ClientValidatorTest
 * @package AppTest\Filters
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientValidatorTest extends TestCase
{
    /** @var ClientValidator */
    protected $clientValidator;

    /**
     * Configuração inicial
     * Executada antes dos testes.
     */
    protected function setUp()
    {
        // Instanciar ClientValidator
        $this->clientValidator = new ClientValidator();
    }

    /**
     * Testar Validar ID
     * @return void
     */
    public function testValidateId()
    {
        $input = 123;
        /** @var Validator $inputValidado1 */
        $inputValidado1 = $this->clientValidator->validateId($input);

        $input = "123";
        /** @var Validator $inputValidado2 */
        $inputValidado2 = @$this->clientValidator->validateId($input);

        // Testes
        $this->assertFalse($inputValidado1->fails());
        $this->assertFalse($inputValidado2->fails());
    }

    /**
     * Testar Validar Nome
     * @return void
     */
    public function testValidateName()
    {
        $input = "123";
        /** @var Validator $inputValidado1 */
        $inputValidado1 = $this->clientValidator->validateName($input);

        $input = " Teste de Nome";
        /** @var Validator $inputValidado2 */
        $inputValidado2 = $this->clientValidator->validateName($input);

        // Testes
        $this->assertTrue($inputValidado1->fails());
        $this->assertFalse($inputValidado2->fails());
    }

    /**
     * Testar Validar E-mail
     * @return void
     */
    public function testValidateEmail()
    {
        $input = "email@dominio.com";
        /** @var Validator $inputValidado1 */
        $inputValidado1 = $this->clientValidator->validateEmail($input);

        $input = "    Teste de E-mail";
        /** @var Validator $inputValidado2 */
        $inputValidado2 = $this->clientValidator->validateEmail($input);

        // Testes
        $this->assertFalse($inputValidado1->fails());
        $this->assertTrue($inputValidado2->fails());
    }

    /**
     * Testar Validar todos os atributos do cliente
     * @return void
     */
    public function testValidateAll()
    {
        $input = [
            'id' => 123,
            'name' => "    Teste de Nome",
            'email' => "  email@dominio.com"
        ];

        /** @var Validator $inputValidado */
        $inputValidado = $this->clientValidator->validateAll($input);

        // Testes
        $this->assertTrue($inputValidado->fails());
    }
}