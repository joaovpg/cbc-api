# `Projeto API Rest - CBC`

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
// o composer tem um limite de tempo de execução de 300 segundos
```

as rotas da api são:

localhost:8000/clubes → GET e POST

localhost:8000/recursos → GET e POST

# 2. Considerações
Como descrito no arquivo de instruções, optei por não utilizar bibliotecas como Laravel, Doctrine ou Symfony para a criação desta API. Em vez disso, desenvolvi tudo utilizando as ferramentas nativas que o PHP oferece. Abaixo está uma breve explicação de como o projeto está estruturado.

- **/config**

  - Arquivo responsável pelas configurações de conexão com o banco de dados.

- **/public**

  - Este diretório contém o ponto de entrada da API, onde são definidos o roteamento e a injeção de dependência.

- **/src/Api/Controllers**

  - Contém os controladores (Controllers) de Clube e Recurso, responsáveis por gerenciar as requisições HTTP `POST` e `GET` para as respectivas rotas.

- **/src/Api/Models**

  - Contém os modelos utilizados para organizar as requisições (Requests) e respostas (Responses) da API.

- **/src/Application/Interfaces**

  - Define as interfaces dos serviços, padronizando as operações que os serviços devem implementar.

- **/src/Application/Services**

  - Contém a implementação dos serviços da API, onde está concentrada toda a lógica de negócio da aplicação.

- **/src/Domain/Model**

  - Classes que representam as entidades do domínio e mapeiam os dados que se relacionam diretamente com o banco de dados.

- **/src/Infrastructure/Interfaces**

  - Define as interfaces dos repositórios, padronizando as operações de acesso aos dados.

- **/src/Infrastructure/Persistence**

  - Contém a classe responsável por criar e gerenciar a conexão com o banco de dados.

- **/src/Infrastructure/Repository**

  - Camada de repositório, onde são implementadas as consultas e interações diretas com o banco de dados.


```tsx
/cbc-api
    /.phan
        config.php
    /config
        config.php
    /public
        index.php
    /src
        /Api
            /Controllers
                ClubeController.php
                RecursoController.php
            /Models
                /Clube
                    ClubeCadastroRequest.php
                /Recurso
                    ConsumirRecursoRequest.php
                    ConsumirRecursoResponse.php
        /Application
            /Interfaces
                IClubeService.php
                IRecursoService.php
            /Services
                ClubeService.php
                RecursoService.php
        /Domain
            /Model
                Clube.php
                Recurso.php
        /Infrastructure
            /Interfaces
                IClubeRepository.php
                IRecursoRepository.php
            /Persistence
                ConnectionCreator.php
            /Repository
                ClubeRepository.php
                RecursoRepository.php
    .gitignore
    composer.json
    README.md
    script_db.sql
```


### Bônus
Também criei um script no composer para checar o código e verificar se há algum erro e se está devidamente indentado segundo as regras da PSR12 utilizando PHAN e PHPCS, para utilizá-lo basta digitar **composer checkcode**.