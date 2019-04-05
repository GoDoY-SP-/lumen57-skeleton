<?php

namespace AppTest\Http\Controllers;

use App\Contracts\ClientCollectionContract;
use App\Contracts\ClientFilterContract;
use App\Contracts\ClientServiceContract;
use App\Contracts\ClientValidatorContract;
use App\Http\Controllers\ClientController;
use App\Repositories\ClientCollection;
use App\Repositories\ClientEntity;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Teste Unitário da Classe ClientController
 * Class ClientControllerTest
 * @package AppTest\Http\Controllers
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientControllerTest extends TestCase
{
    /** @var ClientController */
    protected $clientController;

    /**
     * Configuração inicial
     * Executada antes dos testes.
     */
    protected function setUp()
    {
        /** @var ClientCollectionContract $clientCollection */
        $clientCollection = (new ClientCollection())
            ->add(
                (new ClientEntity())
                    ->setId(1)
                    ->setName("Teste de Nome 1")
                    ->setEmail("email1@dominio.com"))
            ->add(
                (new ClientEntity())
                    ->setId(2)
                    ->setName("Teste de Nome 2")
                    ->setEmail("email2@dominio.com"));

        $clientEntity1 = $clientCollection->current();

        // Profetizar Serviço de Cliente
        $clientService = $this->prophesize(ClientServiceContract::class);
        $clientService->findAll()->willReturn($clientCollection->toArray());
        $clientService->findById(1)->willReturn($clientEntity1->toArray());
        $clientService = $clientService->reveal();

        // Profetizar Filter e Validator de Cliente
        /** @var MockBuilder $validator */
        $validator = $this->getMockBuilder(Validator::class);
        $validator->setMethods(['fails']);
        $validator = $validator->getMock();

        /** @var ClientFilterContract $clientFilter */
        $clientFilter = $this->prophesize(ClientFilterContract::class);
        $clientFilter->filterId($clientEntity1->getId())->willReturn($clientEntity1->getId());
        $clientFilter->filterName($clientEntity1->getName())->willReturn($clientEntity1->getName());
        $clientFilter->filterEmail($clientEntity1->getEmail())->willReturn($clientEntity1->getEmail());
        $clientFilter->filterAll($clientEntity1->toArray())->willReturn($clientEntity1->toArray());
        $clientFilter = $clientFilter->reveal();

        /** @var ClientValidatorContract $clientValidator */
        $clientValidator = $this->prophesize(ClientValidatorContract::class);
        $clientValidator->validateId($clientEntity1->getId())->willReturn($validator);
        $clientValidator->validateName($clientEntity1->getName())->willReturn($validator);
        $clientValidator->validateEmail($clientEntity1->getEmail())->willReturn($validator);
        $clientValidator->validateAll($clientEntity1->toArray())->willReturn($validator);
        $clientValidator = $clientValidator->reveal();

        // Instanciar ClientController
        /** @var ClientController $clientController */
        $this->clientController = new ClientController(
            $clientService,
            $clientValidator,
            $clientFilter
        );
    }

    /**
     * Testar Retornar a listagem de clientes
     * @return void
     */
    public function testList()
    {

        /** @var ClientController $clientController */
        $clientController = $this->clientController;

        /** @var array $clientArray */
        $clientArray = $clientController->list();

        // Testes
        $this->assertArrayHasKey('id', $clientArray[0]);
        $this->assertArrayHasKey('name', $clientArray[0]);
        $this->assertArrayHasKey('email', $clientArray[0]);
        $this->assertTrue(($clientArray[0]['name'] == "Teste de Nome 1"));
        $this->assertTrue(($clientArray[1]['email'] == "email2@dominio.com"));
    }

    /**
     * Testar Retornar os dados de um cliente pelo ID
     * @return void
     */
    public function testGetById()
    {
        /** @var ClientController $clientController */
        $clientController = $this->clientController;

        /** @var array $clientArray */
        $clientArray = $clientController->getById(1);

        // Testes
        $this->assertArrayHasKey('id', $clientArray);
        $this->assertArrayHasKey('name', $clientArray);
        $this->assertArrayHasKey('email', $clientArray);
        $this->assertTrue(($clientArray['name'] == "Teste de Nome 1"));
        $this->assertTrue(($clientArray['email'] == "email1@dominio.com"));
    }
}