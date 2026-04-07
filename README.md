
## Project Setup (Windows)

Use these prerequisites to avoid installation issues on Windows:

- PHP 8.2+
- Composer 2.6+
- Node.js 18+ (or 20 LTS recommended)
- MySQL 8+ or MariaDB

Enable these PHP extensions in php.ini:

- curl
- json
- gd
- openssl
- pdo
- pdo_mysql
- mbstring
- tokenizer
- xml
- zip
- fileinfo
- sodium

Install commands:

```bash
composer install
npm install
```

Build frontend assets:

```bash
npm run build
```

