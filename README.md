
# Gestão de mercado

Para utilizar o sistema e necessario ter o docker em sua maquina!

1. Realize o download do projeto:

```bash
  git clone https://github.com/wellesjr/gestao_de_mercado.git
```

Entre no diretório do projeto abra o terminal na pasta principal e rode o comando:

```docker
  docker-compose up -d --build
```
Para acessar o sistema

```html
  http://localhost:8080
```

 
## Documentação da API

#### Retorna todos os itens

```http
  POST /usuarios/cadastrar_usuario
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `nome`      | `string`   | **Obrigatório**.  |
| `email`     | `string`   | **Obrigatório**.  |
| `senha`     | `string`   | **Obrigatório**.  |)


## Stack utilizada

**Docker, Nginx, Postgres, PHP, React** 


