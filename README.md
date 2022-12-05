## Endpoints

Endpoints: <br>
http://amorim2-001-site1.ftempurl.com/api/coin?coin=bitcoin <br>
http://amorim2-001-site1.ftempurl.com/api/coin/history?coin=bitcoin&date=01-01-2021

## Tecnologias necessárias

* PHP 8
* Composer

## Instalação local

Use o comando "git clone https://github.com/amorimll/laravel-cryptoapi" em uma pasta vazia, em seguida abra a pasta que foi criada, terá o nome de "laravel-cryptoapi", abra um terminal e execute o comando "composer install" para instalar as depedências, para configurar o banco de dados, abra o arquivo .env.example, mude o nome para .env, e troque as informações pelo seu banco de dados correspondente, após a configuração do banco de dados, execute o comando "php artisan migrate" para a criação das tabelas, em caso de algum erro ocorrer, é possível criar a tabela "coins" (id, name, price) manualmente, depois de criar as tabelas, execute o comando "php artisan serve" para iniciar o servidor, o servidor estará rodando na porta 8000, endpoints locais:

* http://localhost:8000/api/coin?coin=bitcoin
* http://localhost:8000/api/coin/history?coin=bitcoin&date=01-12-2021

## Docker (Laravel Sail)

Para criar o ambiente de desenvolvimento usando o docker, usei o laravel sail, as imagens são:

* Servidor MySQL: https://hub.docker.com/repository/docker/amorim2/mysql-server
* Aplicação Laravel: https://hub.docker.com/repository/docker/amorim2/sail-8.1

## Testes

Criei dois testes básicos usando a Feature do laravel, que podem ser executados usando o comando "php artisan test"
