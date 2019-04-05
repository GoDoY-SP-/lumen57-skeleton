# Arquitetura usando Laravel Lumen Framework PHP

Sugestão de arquitetura para uso do micro framework Laravel Lumen.

## Laravel Lumen - Documentação

Clique no link para acessar a documentação do [Laravel Lumen](https://lumen.laravel.com/docs).

## Artefatos propostos

Seguem os artefatos propostos e suas responsabilidades:

- Estrutura de pastas
```
.
├── app
│   ├── Console
│   │   └── Commands
│   ├── Contracts ***
│   ├── Events
│   ├── Exceptions
│   ├── Filters ***
│   ├── Http
│   │   ├── Controllers
│   │   ├── Middleware
│   │   └── Services ***
│   ├── Jobs
│   ├── Listeners
│   ├── Providers
│   └── Repositories ***
├── bootstrap
├── database
│   ├── factories
│   ├── migrations
│   └── seeds
├── public
├── resources
│   └── views
├── routes
├── storage
│   ├── app
│   ├── framework
│   │   ├── cache
│   │   └── views
│   └── logs
└── tests
```
*** Diretórios não existentes na estrutura padrão, criados para separar as responsabilidades destes artefatos. Parto do princípio que os artefatos padrões do Laravel Lumen já são conhecidos, onde abaixo estarei explicando somente os novos artefatos.

- Contracts: Neste diretório ficam todas as Interfaces da aplicação. O ideal é que injeção de dependência no service container aconteça usando essas interfaces/contratos pois caso seja implementada outra classe/serviço para fazer o proposto pela interface/contrato, obrigatoriamente deverão ser implementados os métodos já definidos não necessitando alterar toda a aplicação que usa aquela classe/serviço.
[Clique aqui para mais informações](https://laravel.com/docs/5.7/contracts).

- Filters: Neste diretório ficam os filtros e validadores. Filtros são usados para filtrar dados baseados em formatações como trim, inteiro, alphanumérico, etc. Validadores são usado para validar o tipo do dado. É possível criar suas próprias formatações e validações como CPF, CNPJ, etc. Aconselhável uso do módulo [Zend Filter](https://docs.zendframework.com/zend-filter/) do Zend Framework e [Validator](https://laravel.com/docs/5.7/validation) do Laravel. Este artefato geralmente é usado na camada de controller, filtrando e validando a requisição antes de seguir para as próximas camadas.

- Services: Neste diretório ficam os serviços de domínio responsáveis por processar regras de negócio da aplicação.

- Repositories: Neste diretório ficam os repositórios para persistência de dados. Geralmente eles são de persistência em banco de dados porém podem persistir em outros locais como arquivos locais e/ou externos como nuvem, outras aplicações, etc. No caso do Eloquent ele funciona como uma camada de abstração do model. Para hydratação e mapeamento, aconselhável o uso do módulo [Zend Hydrator](https://docs.zendframework.com/zend-hydrator/) do Zend Framework. Neste diretório também ficam as entidades e coleções do domínio. É aconselhável o uso de adaptadores para diminuir o acoplamento entre as dependências.

---
Pensando em forma de camadas, o fluxo simples de dados seria algo como:

```
[>>  Request |-> Controller |-> Service |-> Repository  \
<<] Response <-| Controller <-| Service <-| Repository  /
```

####IMPORTANTE
É fortemente indicado o uso de injeção de dependência. No caso do Laravel Lumen é recomendado usar o [Service Provider](https://laravel.com/docs/5.7/providers). 

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).