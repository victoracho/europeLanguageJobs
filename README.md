# Detalles del proyecto

Este es un repositorio para la prueba tecnica de EuropeLanguageJobs, para probar conocimientos de programacion fullstack con Laravel y Vue.js. En especifico la prueba tiene logica sencilla dentro de controladores de laravel, manejo de rutas, migraciones, seeders, y autenticacion usando Sanctum. En el front, algunos componentes de quasar, manejo de memoria del cliente con vuex, rutas con vueRouter y el cliente http axios.

## Para empezar

Esta prueba consiste en realizar una SPA sencilla con Vue.js y Laravel, usando el framework de componentes llamado quasar en la que se deben crear, leer, actualizar y eliminar registros relativos a razas de perros. Donde se le agrego un nivel basico de relaciones de base de datos, y el manejo de imagenes referentes a esta tematica desde el servidor.

### Prerrequisitos

Cosas que precisas instalar para correr la app:

Php 8 al menos, composer, NPM, la CLI de Quasar, la CLI de Laravel, mysql y un editor de sql (workbench, phpmyadmin o dbeaver)


### Instalando el API
El proyecto esta dividido en dos carpetas, api correspondiendo al servidor y app para el spa.

1.situarse en la carpeta de api
2. correr el comando, composer install
3. luego crear la bd desde la terminal o desde el editor sql, colocandole el nombre de dogClassifier
4. correr las migraciones y seeders con: php artisan migrate:fresh --seed
5. crear symlinks con php artisan storage:link
6. checar que el script llamado sanctum.php se vea algo asi
```
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
```
7. en tu archivo .env, que las siguientes variables de entorno esten asi:  SESSION_DRIVER=cookie, APP_URL=http://localhost:8000 y SANCTUM_STATEFUL_DOMAINS=http://localhost
8. que tu script sanctum.php tenga los dominios donde trabajara tu spa, junto con el puerto que corresponde
```
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:8080,localhost:3000,127.0.0.1,127.0.0.1:8080,::1',
        env('APP_URL') ? ',' . parse_url(env('APP_URL'), PHP_URL_HOST) : ''
    ))),

```
9. por ultimo deja el servidor corriendo en una instancia de la terminal con php artisa serve, asegurate que corra en el puerto 8000, de lo contrario debes configurar tu .env y las entradas del sanctum.php, segun te convenga.

### Instalando el spa

1. primero asegurate de dirigirte a la carpeta del spa desde la terminal.
2. luego instala todas las dependencias con npm install
3. luego tan solo correo la aplicacion con quasar dev. esta configurado para correr en el puerto 8080, en caso contraro puedes cambiar el parametro del puerto en el archivo quasar.config segun te convenga.



Y poco mas...

Para probar el login prueba usando el correo: victor@gmail.com, junto con la clave 12345


## Hechho con laravel, vue.js, y quasar

Gracias !
