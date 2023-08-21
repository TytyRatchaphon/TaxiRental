# event-management-project-honey-lemon
Website project devlope by Honey Lemon Team. Dedicated to a Web-tech class.

After clone , cd to the folder you've cloned then in your terminal.

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

```bash
sail yarn install
```

```bash
sail yarn dev
```

If you encounter storage not found, try this

```bash
artisan storage:link
```
If still that still doesn't do the trick try...

create a storage folder named " storage " in storage (I know it sound weird)
