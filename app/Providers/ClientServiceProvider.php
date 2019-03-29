<?php

namespace App\Providers;

use App\Contracts\ClientCollectionContract;
use App\Contracts\ClientEntityContract;
use App\Contracts\ClientFilterContract;
use App\Contracts\ClientRepositoryAdapterContract;
use App\Contracts\ClientRepositoryContract;
use App\Contracts\ClientServiceContract;
use App\Contracts\ClientValidatorContract;
use App\Filters\ClientFilter;
use App\Filters\ClientValidator;
use App\Http\Services\ClientService;
use App\Repositories\ClientCollection;
use App\Repositories\ClientEntity;
use App\Repositories\ClientRepository;
use App\Repositories\Eloquent\ClientModel;
use App\Repositories\Eloquent\ClientRepositoryAdapter;
use Illuminate\Support\ServiceProvider;

/**
 * Class ClientServiceProvider
 * Provedor de Serviços de Cliente (DI)
 * @package App\Providers
 */
class ClientServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Fabricar o serviço de clientes (domain)
        $this->app->singleton(ClientServiceContract::class, function ($app) {
            /** @var \Illuminate\Contracts\Foundation\Application $app */

            /** @var ClientRepositoryContract $repositoryAdapter */
            $repository = $app->get(ClientRepositoryContract::class);

            return new ClientService($repository);
        });

        // Fabricar o filtro de clientes
        $this->app->singleton(ClientFilterContract::class, function ($app) {
            /** @var \Illuminate\Contracts\Foundation\Application $app */

            return new ClientFilter();
        });

        // Fabricar o validador de clientes
        $this->app->singleton(ClientValidatorContract::class, function ($app) {
            /** @var \Illuminate\Contracts\Foundation\Application $app */

            return new ClientValidator();
        });

        // Fabricar a entidade de clientes
        $this->app->singleton(ClientEntityContract::class, function ($app) {
            /** @var \Illuminate\Contracts\Foundation\Application $app */

            return new ClientEntity();
        });

        // Fabricar a entidade de clientes
        $this->app->singleton(ClientCollectionContract::class, function ($app) {
            /** @var \Illuminate\Contracts\Foundation\Application $app */

            return new ClientCollection();
        });

        // Fabricar o adaptador para repositório de clientes
        $this->app->singleton(ClientRepositoryAdapterContract::class, function ($app) {
            /** @var \Illuminate\Contracts\Foundation\Application $app */

            $eloquentModel = new ClientModel();
            $clientEntity = $app->get(ClientEntityContract::class);
            $clientCollection = $app->get(ClientCollectionContract::class);

            // Adaptador baseado no Eloquent
            return new ClientRepositoryAdapter(
                $eloquentModel,
                $clientEntity,
                $clientCollection
            );
        });

        // Fabricar o repositório de clientes
        $this->app->singleton(ClientRepositoryContract::class, function ($app) {
            /** @var \Illuminate\Contracts\Foundation\Application $app */

            /** @var ClientRepositoryContract $repositoryAdapter */
            $repositoryAdapter = $app->get(ClientRepositoryAdapterContract::class);

            return new ClientRepository($repositoryAdapter);
        });
    }
}
