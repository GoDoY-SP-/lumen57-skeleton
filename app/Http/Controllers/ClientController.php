<?php

namespace App\Http\Controllers;

use App\Contracts\ClientFilterContract;
use App\Contracts\ClientServiceContract;
use App\Contracts\ClientValidatorContract;

/**
 * Class ClientController
 * Controlador de Rotas de Clientes
 * @package App\Http\Controllers
 * @author Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientController extends Controller
{
    /** @var ClientServiceContract */
    private $clientService;

    /** @var ClientValidatorContract */
    private $clientValidator;

    /** @var ClientFilterContract */
    private $clientFilter;

    /**
     * ClientController constructor.
     * @param ClientServiceContract $clientService
     * @param ClientValidatorContract $clientValidator
     * @param ClientFilterContract $clientFilter
     */
    public function __construct(
        ClientServiceContract $clientService,
        ClientValidatorContract $clientValidator,
        ClientFilterContract $clientFilter
    )
    {
        $this->clientService = $clientService;
        $this->clientValidator = $clientValidator;
        $this->clientFilter = $clientFilter;
    }

    /**
     * Retornar a listagem de clientes
     * @return array | null
     */
    public function list()
    {
        // Retornar dados do repositório
        return $this->clientService->findAll();
    }

    /**
     * Retornar os dadoa de um cliente pelo ID
     * @param int $id
     * @return array | null
     */
    public function getById(int $id)
    {
        // Validar o ID
        $validatorId = $this->clientValidator->validateId($id);
        if ($validatorId->fails()) {
            abort(400, 'Requisição Inválida');
        }

        // Filtrar o ID
        $id = $this->clientFilter->filterId($id);

        // Retornar dados do repositório
        return $this->clientService->findById($id);
    }
}
