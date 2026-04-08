# Business Management System Backend

Laravel backend for the   service platform (Customer, Provider, Booking, Payment, Promotion, Chat, Zone, and related modules).

## Stack

- PHP 8.2+
- Laravel 12
- MySQL
- Laravel Passport (API auth)
- Nwidart Modules

## Prerequisites

- PHP 8.2 or newer with required extensions (`curl`, `json`, `gd`, `mysqli`, `openssl`)
- Composer 2+
- MySQL 8+ (or compatible MariaDB)
- Node.js + npm (only if you need frontend assets via Laravel Mix)

## Local Setup

```bash
cd business_management_system
composer install
cp .env.example .env
php artisan key:generate
```

Update `.env` values for your local machine:

- `APP_URL` (for local API/UI links)
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

Then run database setup:

```bash
php artisan migrate --seed
```

Generate Passport keys (required for API auth flows):

```bash
php artisan passport:keys --force
```

Optional storage symlink:

```bash
php artisan storage:link
```

## Run In Development

Recommended command used by this workspace:

```bash
php artisan serve --no-reload --host=127.0.0.1 --port=8000
```

Backend base URL in this setup:

- `http://127.0.0.1:8000`

Optional asset pipeline (if needed):

```bash
npm install
npm run dev
```

## API Information

### Base URL and Versioning

- Base URL: `http://127.0.0.1:8000`
- Primary mobile API prefix used by current apps: `/api/v1`

### Common Request Headers

Most mobile requests include:

- `Content-Type: application/json; charset=UTF-8`
- `X-localization: <language-code>` (example: `en`)
- `guest_id: <uuid>`
- `Authorization: Bearer <token-or-null>`
- `zoneId: <zone-id-or-configuration>`

### Frequently Used Endpoints (Customer app)

- `GET /api/v1/customer/config`
- `POST /api/v1/customer/change-language`
- `POST /api/v1/customer/auth/login`
- `POST /api/v1/customer/auth/registration`
- `POST /api/v1/customer/auth/social-login`
- `POST /api/v1/customer/auth/logout`
- `POST /api/v1/customer/update/fcm-token`

### Social Login Payload (request body)

```json
{
	"email": "user@example.com",
	"userName": "User Name",
	"token": "provider_access_token",
	"unique_id": "provider_user_id",
	"medium": "google",
	"phone": null,
	"guest_id": "guest-uuid"
}
```

`medium` is usually one of:

- `google`
- `facebook`
- `apple`

### Response Pattern

Many endpoints return a response envelope similar to:

```json
{
	"response_code": "default_200",
	"message": "...",
	"content": {}
}
```

## Quick API Smoke Checks

```bash
curl http://127.0.0.1:8000/api/v1/customer/config

curl -X POST http://127.0.0.1:8000/api/v1/customer/change-language \
	-H "Content-Type: application/json" \
	-H "X-localization: en" \
	-d '{"guest_id":"local-test-guest"}'
```

## Troubleshooting

### Invalid key supplied (Passport)

If API endpoints fail with auth-related 500 errors and logs mention `Invalid key supplied`:

```bash
php artisan passport:keys --force
```

### `update/fcm-token` returns 401

This is expected when calling the endpoint with a guest or null bearer token. Authenticate first to receive success for user-bound token updates.

### Route list command fails unexpectedly

In this codebase, route discovery can fail if a payment gateway config is incomplete at boot time. Use runtime endpoint checks as a fallback while fixing gateway config.

## Testing

```bash
php artisan test
```

## Related Project

Customer mobile/web app lives in sibling folder:

- `../User app and web`

