# `*Projeto API Rest - CBC*`

## 1. Configuração do ambiente

### Instalar tecnologias:

- PHP 8.2
- Composer 2.8
- MySQL 8.4.2 LTS
- Git

**Obs:** Após instalar o PHP e o composer, é necessário habilitar o driver do SQL no arquivo php.ini, você pode achar o caminho para o arquivo digitando o comando abaixo no CMD.

```jsx
php -i | find "Loaded Configuration File"

// Resultado esperado -> C:\caminho\do\arquivo\php.ini
```

Abra o arquivo com o bloco de notas e procure por **;extension=pdo_mysql** e remova o **;** e depois salve e feche o arquivo.

```jsx
// Antes
;extension=pdo_mysql

// Depois
extension=pdo_mysql
```

### Clonar repositório

```jsx
git clone https://github.com/joaovpg/cbc-api.git
```

Você pode baixar o arquivo zip por aqui também: https://github.com/joaovpg/cbc-api/archive/refs/heads/main.zip

**Obs:** Descompacte o arquivo no local de sua preferência.

### Execute o script de criação do banco de dados

O arquivo **script_db.sql** contém o script da criação do banco de dados, das tabelas CLUBE e RECURSO e a inserção dos dados na tabela de recurso.

Copie o script e execute diretamente em um cliente MYSQL (como MySQL Workbench).

**Configurar acesso ao banco**

Vá em no arquivo **config.php** localizado em **config/config.php** e altere as informações do banco de acordo com as configurações do MYSQL instalado em sua máquina, principalmente o **usuário** e a **senha**.

```php
<?php
// Informações do banco de dados
    const DBDRIVE = 'mysql'; // Driver
    const DBHOST = 'localhost'; // Host
    const DBNAME = 'db_api_cbc'; // Nome
    const DBUSER = 'root'; // Usuário
    const DBPASS = 'root'; // Senha
```

### Instalando as dependências do projeto

Abra o terminal na pasta do projeto e execute os comandos abaixo:

```jsx
// Instala as dependências do projeto.
composer install

// Gera/reescreve o arquivo autoload
composer dump-autoload
```

### Execute a API

A partir desse momento você já pode executar a API com o comando:

```jsx
php -S localhost:8000 -t public public/index.php

// OU

composer startserver
// criei esse comando para facilitar a execução, porém
// o composer tem um limite de tempo de execução de 500ms
```

as rotas da api são:

localhost:8000/clubes → GET e POST

localhost:8000/recursos → GET e POST

# 2. Considerações
A fazer