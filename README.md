# Locadora de filmes

Este projeto simula um serviço locação de filmes.

## Índice

- [Sobre](#sobre)
- [Tecnologias utilizadas](#tecnologias-utilizadas)
- [Pré requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Como Usar](#como-usar)
- [Testes](#testes)
- [Funcionamento](#funcionamento)

## Sobre

Neste projeto é possivel fazer a locação de filmes (mídia física), que só possui um exemplar de cada
filme. É possível realizar a reserva online e retirar o filme na locadora.

## Tecnologias Utilizadas
A aplicação foi desenvolvida utilizando as Tecnologias abaixo, segue links para consultas de documentação:

- [Laravel 10.x](https://laravel.com/docs/10.x) - Backend PHP Framework
- [Docker](https://docs.docker.com/) - Aplicação Rodando em Container Docker

## Pré requisitos

Certifique-se de ter as seguintes ferramentas instaladas em sua máquina:

- Git
- Docker [docker](https://docs.docker.com/get-docker/)
- Docker Compose


## Instalação

Siga estes passos para instalar o projeto:

Clone o repositório:

```bash
git clone git@github.com:leandrogoncalves/locadora_filmes.git
```
Entre no diretório do projeto

```bash
  cd locadora_filmes
```

Crie o .env
```bash
    cp .env.example .env
```

Suba os containers
```bash
    docker compose up
```

Gere a chave de encriptação da aplicação
```bash
    docker exec -it app sh -c "php artisan key:generate"
```

Rode as migrações e seeders
```bash
    docker exec -it app sh -c "php artisan migrate --seed"
```

Execute o build do frontend
```bash
    docker exec -it app sh -c "npm i && npm run build"
```

## Como Usar

Após subir os containers, acesse a url http://127.0.0.1:8090 seu navegador. Se a instalação foi bem sucedida, você terá o seguinte retorno:

<img src="/storage/app/img/print.png">

Você pode acessar documentação dos endpoints do projeto acesse o link http://127.0.0.1:8090/api/docs

## Testes

Esse projeto possui alguns testes que garantem a validação dos dados obrigatórios nos endpoints e a comunição com os MOCs de notificação e validação de transações.

Pra executar os testes:

Suba os containers:
```bash
    docker compose up
```

Rode os testes:
```bash
    docker exec -it app sh -c "php artisan test"
```

## Funcionamento

Endpoints:

### Listar filmes

Endpoint responsável por listar filmes disponíveis para locação.

```bash
GET /api/v1/filmes
[
    {
        id: guid,
        name: string,
        synopsis: string,
        rating: string
    }
]
```

### Reservar filme

Este endpoint é responsável por efetuar a reserva do filme, deve ter um tempo prédeterminado e configurável (3 horas), ao executar a reserva o sistema deverá retornar
um id identificando a reserva.

// payload
```bash
POST /api/v1/rental
{
    movieId: guid
}
```

// response body
```bash
{
    reserveId: guid
}
```

### Confirmar locação

Este endpoint é responsável por executar a confirmação da locação e receber os
dados do cliente.

// payload

```bash
POST /api/v1/rental/confirmation

{
    reserveId: guid,
        customer: {
            name: string,
            email: string,
            phone: string
        }
}
```

// response body

```bash
{
    scheduleId: guid,
    status: 'LEASED'
}
```

### Devolver filme

Este endpoint é responsável por executar a devolução do filme, deve receber o id da
locação.


// payload

```bash
POST /api/v1/rental/return
{
    scheduleId: guid
}
```

// response body

```bash
{
    scheduleId: guid,
    status: 'RETURNED'
}
```

