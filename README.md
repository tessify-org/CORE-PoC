# Tessify Core

This is the core of the tessify codebase. A detailed description will follow soon.

## Installation instructions

### I. Preparing the server

Make sure the server meets the requirements:
- Apache
- PHP 7.2
- MySQL

The following PHP modules need to be installed and activated:
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

For more information on server requirements see [the Laravel documentation](https://laravel.com/docs/6.x/installation).

For instructions on how to install the LAMP stack on a server see [this DigitalOcean tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04).

#### Composer

Composer is the PHP package manager we'll be using to install all of the applications dependencies.

Windows users can download & install it from [https://www.getcomposer.org](https://www.getcomposer.org).

Linux users can run ```sudo apt-get install composer``` to install composer.

#### Node.js

Node.js is used to compile all of our frontend assets and will need to be installed on, at least, the development machine. If you're simply pushing your code to your server all of your frontend assets will already be compiled so it does not have to be installed on the server.

Windows users can download & install it from [https://www.nodejs.org](https://www.nodejs.org).

Linux users should run the following commands to automatically install the latest version of node.js & npm:

```bash
sudo apt-get install curl
curl -sL https://deb.nodesource.com/setup_13.x | sudo -E bash -
sudo apt-get install nodejs
```

### II. Installing the application

1. Clone this repository and cd into it:

```
git clone https://github.com/tessify-org/CORE.git tessify-core
cd tessify-core
```

2. Install it's PHP dependencies using composer:

```
composer install
```

3. Create a MySQL database
4. Create a new file called ```.env``` (by copying the ```.env.example``` file)
5. Open the ```.env``` file and set at least the following vars:

```
APP_NAME=
APP_URL=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

6. Migrate & seed the database by running the following command:
```
php artisan migrate --seed
```

7. Generate an encryption key
```
php artisan key:generate
```

8. Create a symlink for the storage directory to public
```
php artisan storage:link
```
*If you're on windows and you're using Homestead, which we recommmend, make sure you run Vagrant as an Administrator. Otherwise this command will fail*

9. Install frontend dependencies
```
npm install
```

10. Open up the ```webpack.mix.js``` file and edit the following lines to match your environment and preferences:

```
mix.disableNotifications().browserSync({
    proxy: 'core.test',
    port: 3000
});
```

11. Compile frontend assets
```
npm run watch
```
or
```
npm run build
```


### III. Configure emails

The Laravel documentation has detailed instructions on how to configure different email providers. We recommend using [Mailtrap.io](https://www.mailtrap.io) during development.

### IV. Setup supervisor

The application currently does not use jobs & queues. Instructions on how to setup Supervisor will follow as soon as queues are implemented.

### V. Production Environment

Make sure to set the following environment variables when working in a production environment:

```
APP_ENV=production
APP_DEBUG=false
```

This way when an error occurs visitors won't be able to get any information from the error messages.

### Done!

