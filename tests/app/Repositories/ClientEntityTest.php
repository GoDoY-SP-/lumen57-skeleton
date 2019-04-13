<?php

namespace AppTest\Repository;

use App\Repositories\ClientEntity;
use PHPUnit\Framework\TestCase;

/**
 * Teste Unitário da Classe ClientEntity
 * Class ClientEntityTest
 * @package AppTest\Repository
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientEntityTest extends TestCase
{
    /**
     * Configuração inicial
     * Executada antes dos testes.
     */
    protected function setUp()
    {
        // Sem configuração
    }

    /**
     * Testar Retornar todos os clientes
     * @return void
     */
    public function testEntity()
    {
        $entity = new ClientEntity();
        $entity
            ->setId(1)
            ->setName('Teste de Nome')
            ->setEmail('teste@email.com');

        // Testar entidade
        $this->assertTrue(($entity->getId() == 1));
        $this->assertTrue(($entity->getName() == 'Teste de Nome'));
        $this->assertTrue(($entity->getEmail() == 'teste@email.com'));

        // testar conversão para array
        $entityArray = $entity->toArray();
        $this->assertArrayHasKey('id', $entityArray);
        $this->assertArrayHasKey('name', $entityArray);
        $this->assertArrayHasKey('email', $entityArray);

        // testar conversão para json
        $entityJson = $entity->toJson();
        $this->assertJson($entityJson);
    }
}