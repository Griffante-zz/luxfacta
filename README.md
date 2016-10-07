# Plano de Implantação

## Pré-Requisitos
* Git
* Servidor Apache >= 2.4.23
* PHP >= 5.5.9
* Extensão PHP OpenSSL
* Extensão PHP PDO
* Extensão PHP Mbstring
* Extensão PHP Tokenizer

## Banco de Dados
O Framework Laravel utilizado nesta aplicação é compatível com os seguintes bancos de dados:
* MySQL
* Postgres
* SQLite
* SQL Server

Habilite a extensão PHP PDO para o banco de dados desejado.
Caso queira utilizar a base de dados populada para o banco de dados MySQL, [clique aqui](https://github.com/Griffante/luxfacta/blob/master/luxfacta.sql).
Caso queria trabalhar com uma base de dados vazia, execute o comando abaixo para criar a estrutura em seu banco de dados:

        php artisan migrate
  

## Passo-a-Passo

### 1 - Código Fonte

**Clone o repositório do GitHub**

        git clone https://github.com/Griffante/luxfacta.git

Para mais detalhes sobre o GIT, confira esse [Guia Prático](http://rogerdudler.github.io/git-guide/index.pt_BR.html).

### 2 - Banco de Dados
Crie uma base de dados, por exemplo, no MySQL:

        CREATE DATABASE luxfacta;


Configure os arquivos:

**config/database.php**

        'connections' => [

            'sqlite' => [...],

            'mysql' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', '3306'),
                'database' => env('DB_DATABASE', 'luxfacta'),
                'username' => env('DB_USERNAME', 'root'),
                'password' => env('DB_PASSWORD', 'root'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ],

            'pgsql' => [...],

        ],

**.env**

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=luxfacta
        DB_USERNAME=root
        DB_PASSWORD=root
    
 
### 3 - Apache Config
 
 Caso o Módulo **Rewrite** do Apache esteja habilitado e mesmo assim, a URL amigável "/public/produtos" não funcione, adicione as linhas em seu arquivo de configuração: 

        <Directory /var/www/html/luxfacta/public>
          Options Indexes FollowSymLinks
          AllowOverride All
          Require all granted
        </Directory>

O exemplo acima é para o Linux Ubuntu. Configure o caminho correto para o directório de sua aplicação no apache.
  
  
  
