# BASE LARAVEL

Overwrite app folder to your laravel project

- Include mongodb feature to project

Install the package via Composer:
  
    $ composer require jenssegers/mongodb
    
add the service provider to config/app.php:

    Jenssegers\Mongodb\MongodbServiceProvider::class,

add a new mongodb connection to config/database.php

    'mongodb' => [
        'driver' => 'mongodb',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', 27017),
        'database' => env('DB_DATABASE', 'homestead'),
        'username' => env('DB_USERNAME', 'homestead'),
        'password' => env('DB_PASSWORD', 'secret'),
        'options' => [
            // here you can pass more settings to the Mongo Driver Manager
            // see https://www.php.net/manual/en/mongodb-driver-manager.construct.php under "Uri Options" for a list of complete parameters that you can use
    
            'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
        ],
    ],    
    
After create model, you must extends MongoBaseModel:

    use app\Models\MongoBaseModel;
    
    class Book extends MongoBaseModel
    {
        //
    }
