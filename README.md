Clone o repositório:

```git clone https://github.com/MateusAntunes95/carrinho_compra.git```

Crie o arquivo .env a partir de .env.example.

``` cp .env.example .env ```

Rode os seguintes comandos na raiz do projeto:
```
 docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

``` 
vendor/bin/sail up -d
```

``` 
sudo chmod -R 777 storage
```

```
sudo chmod -R 777 .env
```

``` 
vendor/bin/sail php artisan key:generate
 ```

``` 
vendor/bin/sail php artisan migrate
```

Projeto aberto na porta http://localhost:90/

Dados criado automaticamente:
Email: admin@teste.com
Password: 123

Comando para executar o teste:
```
php artisan test
```
