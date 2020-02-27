# Tessify Core Proof of Concept

This application is the development & poc version of the Tessify core codebase.

## Installation instructions

For detailed instructions see our [Wiki](https://github.com/tessify-org/CORE/wiki).

- [Setting up your local development environment](https://github.com/tessify-org/CORE/wiki/Development-Setup)
- [Setting up the production server](https://github.com/tessify-org/CORE/wiki/Server-Setup)

## Quick setup

1. ```git clone --recurse-submodules https://github.com/tessify-org/CORE-PoC.git```
2. Setup your environment (host file, database, virtualhosts if applicable etc..)
3. ```cp .env.example .env```
4. ```nano .env```
5. Set database & credentials
```
DB_DATABASE=core
DB_USERNAME=youruser
DB_PASSWORD=yourpassword
```
6. ```php artisan key:generate```
7. ```php artisan migrate --seed```
8. ```php artisan storage:link```

At this point the application should be available.
Run the following commands for a live-reload version, which is recommended during development.

9. ```nano webpack.mix.js``` adjust to your environment
10. ```npm install```
11. ```npm run watch```

That's it!