# Sistema de Abertura de Chamados

Este projeto é um sistema de abertura de chamados desenvolvido utilizando tecnologias modernas como Laravel 11, Vue.js 3, PHP 8.4 e Node.js 18. O projeto está configurado para ser executado utilizando Docker e Docker Compose, proporcionando uma configuração simplificada e pronta para uso.

## Pré-requisitos

Certifique-se de ter os seguintes softwares instalados em sua máquina:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Configuração Inicial

1. Clone o repositório do projeto.
2. Copie o arquivo `.env.example` para um novo arquivo `.env`:
   ```bash
   cp .env.example .env
   ```
3. Configure as variáveis de ambiente no arquivo `.env`, se necessário.

## Executando a API

1. Navegue até o diretório `/api`:
   ```bash
   cd api
   ```
2. Inicie os containers com o Laravel Sail:
   ```bash
   sail up -d
   ```
3. Gere a chave JWT necessária para autenticação:
   ```bash
   sail artisan jwt:secret
   ```
4. Execute as migrations para configurar o banco de dados:
   ```bash
   sail artisan migrate
   ```

### Executando Filas

Para processar filas de alta prioridade e padrão:

1. Navegue até o diretório `/api`:
   ```bash
   cd api
   ```
2. Execute o seguinte comando:
   ```bash
   sail artisan queue:work --queue=high,default
   ```

### Criando Suporte e Cliente

Use o Tinker, disponível no Laravel, para criar usuários do tipo suporte e cliente:
```bash
sail artisan tinker
```

## Executando o Frontend

1. Navegue até o diretório `/front`:
   ```bash
   cd front
   ```
2. Inicie os containers do frontend com o Docker Compose:
   ```bash
   docker-compose up -d
   ```

## Acessos

- **pgAdmin**: Disponível em [http://localhost:15432/](http://localhost:15432/)
  - **E-mail**: `admin@admin.com`
  - **Senha**: `admin`

- **PostgreSQL**:
  - **Host**: `postgres`
  - **Usuário**: `postgres`
  - **Senha**: `postgres`
  - **Banco de Dados**: `postgres`

---

Com estas instruções, você terá o sistema de abertura de chamados funcionando em seu ambiente local.