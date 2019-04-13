<?php

namespace AppTest\Http\Service;

use App\Contracts\ClientRepositoryContract;
use App\Contracts\ClientServiceContract;
use App\Http\Services\ClientService;
use App\Repositories\ClientCollection;
use App\Repositories\ClientEntity;
use PHPUnit\Framework\TestCase;

/**
 * Teste Unitário da Classe ClientService
 * Class ClientServiceTest
 * @package AppTest\Http\Service
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientServiceTest extends TestCase
{
    /**
     * Configuração inicial
     * Executada antes dos testes.
     */
    protected function setUp(): void
    {
        // Sem configuração
    }

    /**
     * Testar Retornar todos os clientes
     * @return void
     */
    public function testFindAll()
    {
        // Profetizar Repositório de Cliente
        $repositorio = $this->prophesize(ClientRepositoryContract::class);
        $repositorio->findAll()->willReturn(
            (new ClientCollection())
                ->add(
                    (new ClientEntity())
                        ->setId(1)
                        ->setName("Teste de Nome 1")
                        ->setEmail("email1@dominio.com"))
                ->add(
                    (new ClientEntity())
                        ->setId(2)
                        ->setName("Teste de Nome 2")
                        ->setEmail("email2@dominio.com"))
        );
        $repositorio = $repositorio->reveal();

        // Instanciar ClientService
        /** @var ClientServiceContract $clientServico */
        $clientServico = new ClientService($repositorio);

        /** @var array $clientArray */
        $clientArray = $clientServico->findAll();

        // Testes
        $this->assertArrayHasKey('id', $clientArray[0]);
        $this->assertArrayHasKey('name', $clientArray[0]);
        $this->assertArrayHasKey('email', $clientArray[0]);
        $this->assertTrue(($clientArray[0]['name'] == "Teste de Nome 1"));
        $this->assertTrue(($clientArray[1]['email'] == "email2@dominio.com"));
    }

    /**
     * Testar Retornar um cliente por ID
     * @return void
     */
    public function testFindById()
    {
        // Profetizar Repositório de Cliente
        $repositorio = $this->prophesize(ClientRepositoryContract::class);
        $repositorio->findById(2)->willReturn(
            (new ClientCollection())
                ->add(
                    (new ClientEntity())
                        ->setId(2)
                        ->setName("Teste de Nome 2")
                        ->setEmail("email2@dominio.com"))
        );
        $repositorio = $repositorio->reveal();

        // Instanciar ClientService
        /** @var ClientServiceContract $clientServico */
        $clientServico = new ClientService($repositorio);

        /** @var array $clientArray */
        $clientArray = $clientServico->findById(2);

        // Testes
        $this->assertArrayHasKey('id', $clientArray[0]);
        $this->assertArrayHasKey('name', $clientArray[0]);
        $this->assertArrayHasKey('email', $clientArray[0]);
        $this->assertTrue(($clientArray[0]['name'] == "Teste de Nome 2"));
        $this->assertTrue(($clientArray[0]['email'] == "email2@dominio.com"));
    }
}