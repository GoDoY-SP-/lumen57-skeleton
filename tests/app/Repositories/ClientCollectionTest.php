<?php

namespace AppTest\Repository;

use App\Repositories\ClientCollection;
use App\Repositories\ClientEntity;
use PHPUnit\Framework\TestCase;

/**
 * Teste Unitário da Classe ClientCollection
 * Class ClientCollectionTest
 * @package AppTest\Repository
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientCollectionTest extends TestCase
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
    public function testCollection()
    {
        $colletion = new ClientCollection();

        $entity = new ClientEntity();
        $entity
            ->setId(1)
            ->setName('Teste de Nome')
            ->setEmail('teste@email.com');

        $colletion->add($entity);

        $entity = new ClientEntity();
        $entity
            ->setId(2)
            ->setName('Teste de Nome 2')
            ->setEmail('teste2@email.com');

        $colletion->add($entity);

        // Testar collection
        $this->assertTrue(($colletion->count() == 2));
        $this->assertInstanceOf(ClientEntity::class, $colletion->current());
        $colletion->next();
        $this->assertTrue(($colletion->current()->getId() == 2));
        $colletion->remove($entity);
        $this->assertTrue(($colletion->count() == 1));

        // testar conversão para array
        $colletionArray = $colletion->toArray();
        $this->assertIsArray($colletionArray);
        $this->assertArrayHasKey('id', $colletionArray[0]);
        $this->assertArrayHasKey('name', $colletionArray[0]);
        $this->assertArrayHasKey('email', $colletionArray[0]);
    }
}