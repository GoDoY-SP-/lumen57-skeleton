Lumen 5.7 com Docker Containers 
=========================
![picture](img/logo_docker.png)

Introdução
----------
Laravel Lumen é um micro-framework PHP. 
[Docker](https://www.docker.com/) é uma plataforma Open Source escrito em Go, que é uma linguagem de programação de alto desempenho desenvolvida dentro do Google, que facilita a criação e administração de ambientes isolados.


Instalação
------------
Você deve acesso a parte de [Downloads](https://www.docker.com/products/overview) do site do Docker e escolher a versão para seu sistema operacional.

Criar rede
----------
Você deverá criar uma rede "lumen57" para rodar seus containers.

```
#!bash
	### Criar rede lumen57
	$ docker network create -d bridge lumen57
```

Instanciar containers
---------------------
![picture](img/logo_mariadb.png)
	
Você deverá acessar a pasta onde estão os arquivos de configuração do Docker baseado no servidor HTTP Apache, escolhendo a versão desejada do PHP.

```
#!bash
	### MariaDB
	$ cd ./docker-db/mariadb10.2
```
	
Para iniciar os containers, você deverá utililzar o [Docker Compose](https://docs.docker.com/compose/):

```
#!bash
    $ docker-compose up -d
```

Para parar os containers:

```
#!bash
    $ docker-compose stop
```

Para ver os containers rodando:

```
#!bash
    $ docker ps
```

	
Configurações
-------------
Caso precise alterar as configurações dos containers, será necessário alterar os arquivos da pasta "config" da versão desejada do DB.

	### DB
	|-- config
    |   |-- secrets
    |   |   `-- mysql-root
    |   `-- Dockerfile
    