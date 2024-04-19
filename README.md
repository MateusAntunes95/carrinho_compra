Clone o repositório:

```
git clone https://github.com/MateusAntunes95/carrinho_compra.git
```

Crie o arquivo .env a partir de .env.example.

``` 
cp .env.example .env
```

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

``` 
vendor/bin/sail php artisan db:seed
``` 

Configuração do Frontend (React)

```
cd ../frontend
```


```
npm install
```

```
npm start
``` 

O frontend estará acessível em http://localhost:3000

Usuario para teste

Email:

```
admin@teste.com
```
Senha:
```
123
```

