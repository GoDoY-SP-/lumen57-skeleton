<?php

namespace AppTest\Filters;

use App\Filters\ClientFilter;
use PHPUnit\Framework\TestCase;

/**
 * Teste Unitário da Classe ClientFilter
 * Class ClientFilterTest
 * @package AppTest\Filters
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientFilterTest extends TestCase
{
    /** @var ClientFilter */
    protected $clientFilter;

    /**
     * Configuração inicial
     * Executada antes dos testes.
     */
    protected function setUp()
    {
        // Instanciar ClientFilter
        $this->clientFilter = new ClientFilter();
    }

    /**
     * Testar Filtrar ID
     * @return void
     */
    public function testFilterId()
    {
        $input = "    123";
        $inputFiltrado = $this->clientFilter->filterId($input);

        // Testes
        $this->assertTrue(($inputFiltrado == preg_replace('/[^0-9]i/', '', $input)));
    }

    /**
     * Testar Filtrar Nome
     * @return void
     */
    public function testFilterName()
    {
        $input = "    Teste de Nome";
        $inputFiltrado = $this->clientFilter->filterName($input);

        // Testes
        $this->assertTrue(($inputFiltrado == trim(strtoupper($input))));
    }

    /**
     * Testar Filtrar E-mail
     * @return void
     */
    public function testFilterEmail()
    {
        $input = "  email@dominio.com";
        $inputFiltrado = $this->clientFilter->filterEmail($input);

        // Testes
        $this->assertTrue(($inputFiltrado == trim($input)));
    }

    /**
     * Testar Filtrar todos os atributos do cliente
     * @return void
     */
    public function testFilterAll()
    {
        $input = [
            'id' => "    123",
            'name' => "    Teste de Nome",
            'email' => "  email@dominio.com"
        ];

        $inputFiltrado = $this->clientFilter->filterAll($input);
        $comparativo = null;

        foreach ($inputFiltrado as $campo => $valor) {
            switch ($campo) {
                case 'id':
                    $comparativo = ($inputFiltrado[$campo] == preg_replace('/[^0-9]i/', '', $input[$campo]));
                    break;
                case 'name':
                    $comparativo = ($inputFiltrado[$campo] == trim(strtoupper($input[$campo])));
                    break;
                case 'email':
                    $comparativo = ($inputFiltrado[$campo] == trim($input[$campo]));
                    break;
            }

            // Testes
            $this->assertTrue($comparativo);
        }
    }
}