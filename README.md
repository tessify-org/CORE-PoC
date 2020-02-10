# Tessify Core

This is the core of the tessify codebase. A detailed description will follow soon.

## Installation instructions

For a detailed instructions see our [Wiki](https://github.com/tessify-org/CORE/wiki).

- [Setting up your local development environment](https://github.com/tessify-org/CORE/wiki/Development-Setup)
- [Setting up the production server](https://github.com/tessify-org/CORE/wiki/Server-Setup)

## Quick setup

1. ```git clone https://github.com/tessify-org/CORE.git```
2. ```cp .env.example .env```
3. ```nano .env```
4. Set database & credentials
```
DB_DATABASE=core
DB_USERNAME=youruser
DB_PASSWORD=yourpassword
```
5. ```php artisan key:generate```
6. ```php artisan migrate --seed```
7. ```php artisan storage:link```
8. ```nano webpack.mix.js``` adjust to your .env settings
9. ```npm install```
10. ```npm run watch```
11. Update your hosts file (```/etc/hosts``` or ```C:/Windows/System32/drivers/etc/hosts```)