# Locadora de filmes

Este projeto simula um serviço locação de filmes.

## Índice

- [Sobre](#sobre)
- [Instalação](#instalação)
- [Como Usar](#como-usar)
- [Testes](#testes)
- [Funcionamento](#funcionamento)

## Sobre

Neste projeto é possivel fazer a locação de filmes (mídia física), que só possui um exemplar de cada
filme. É possível realizar a reserva online e retirar o filme na locadora.

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

## Como Usar

Após subir os containers, acesse a url http://127.0.0.1:8090/api/health em seu navegador. Se a instalação foi bem sucedida, você terá o seguinte retorno:

```json
    {
        "status": "Operational"
    }
```

Você pode acessar documentação dos endpoints do projeto [clicando aqui](https://documenter.getpostman.com/view/19570429/2sA2r824Sc#8591c6c4-b293-42b4-a80b-32674f03355d)

## Testes

Esse projeto possui alguns testes que garantem a validação dos dados obrigatórios nos endpoints e a comunição com os MOCs de notificação e validação de transações.

Pra executar os testes:

Suba os containers:
```bash
    docker compose up
```

Rode os testes:
```bash
    docker exec -it payment-app php artisan test
```

## Funcionamento

Sugestão de teste:

1. Cadastre dois usuários comuns.

