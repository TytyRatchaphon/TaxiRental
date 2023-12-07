# Taxi Rental Web application
Website project devlope by TytyRatchaphon . Dedicated to a System Analysis class.

Run these commands
 

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

```bash
cp .env.example .env
```

```bash
sail up -d
```

```bash
sail artisan key:generate
```

```bash
sail artisan migrate
```
If you want some data examples too.. then..

```bash
sail artisan migrate:fresh --seed
```

```bash
sail yarn install
```

```bash
sail yarn dev
```

