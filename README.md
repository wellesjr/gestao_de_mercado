
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
| `senha`     | `string`   | **Obrigatório**.  |


## Galeria

###Login
![App Screenshot](https://github.com/wellesjr/gestao_de_mercado/blob/main/frontend/src/assets/Captura%20de%20tela%202024-04-29%20102902.png)

###Vendas
![App Screenshot](https://github.com/wellesjr/gestao_de_mercado/blob/main/frontend/src/assets/Captura%20de%20tela%202024-04-29%20103053.png)

###Cadastros
![App Screenshot](https://github.com/wellesjr/gestao_de_mercado/blob/main/frontend/src/assets/Captura%20de%20tela%202024-04-29%20103207.png)
![App Screenshot](https://github.com/wellesjr/gestao_de_mercado/blob/main/frontend/src/assets/Captura%20de%20tela%202024-04-29%20103251.png)
![App Screenshot](https://github.com/wellesjr/gestao_de_mercado/blob/main/frontend/src/assets/Captura%20de%20tela%202024-04-29%20103312.png)

## Stack utilizada

**Docker, Nginx, Postgres, PHP, React** 


