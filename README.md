## Requirements

- `PHP >8.1`
- `Node.js >16.0`
- `yarn`
- ` crontab`
  - `* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`

## Installation

### 1. Clone the repository

`git clone https://github.com/HolgerHatGarKeineNode/bitgift`

### 2. Install dependencies

`composer install`

### 3. Create .env file

`cp .env.example .env`

### 4. Configure .env file

```dotenv
MIN_WITHDRAW=10000

ADMIN_NAME=CHANGEME
ADMIN_EMAIL=change@changeme.de
ADMIN_PASSWORD="changeme"
ADMIN_LNBITS_URL=https://changeme.de
ADMIN_LNBITS_API_KEY=changeme
```

### 5. Execute installation script

`php artisan install`

### 6. Login to the admin panel

`/login`

## Todo

- [x] Create withdraw links
- [x] Delete withdraw links
- [ ] cronjob for deleting expired links
- [ ] Refactor installation process
- [ ] Refactor configuration process
- [ ] Provide documentation for self-hosting
- [ ] adapter for BTCpayserver
- [ ] Add tests

## Development

### Installation

```cp .env.example .env```

Configure `.env` file!

```dotenv
MIN_WITHDRAW=10000

ADMIN_NAME=CHANGEME
ADMIN_EMAIL=change@changeme.de
ADMIN_PASSWORD="changeme"
ADMIN_LNBITS_URL=https://changeme.de
ADMIN_LNBITS_API_KEY=changeme
```

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

#### Start docker development containers

```vendor/bin/sail up -d```

### Migrate and seed the database

```./vendor/bin/sail artisan migrate:fresh --seed```

### Laravel storage link

```./vendor/bin/sail artisan storage:link```

#### Install node dependencies

```vendor/bin/sail yarn install```

#### Start just in time compiler

```vendor/bin/sail yarn dev```

#### Update dependencies

```vendor/bin/sail yarn```

## Contributing

WIP

## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
