# ImexHs
## Requerimientos
 - PHP 7.4
 - extension=curl
 - extension=fileinfo
 - extension=gd2
 - extension=gettext
 - extension=mbstring
 - extension=exif
 - extension=mysqli
 - extension=openssl
 - extension=pdo_mysql
 - extension=ext-json

## Instalación
Instalar dependencias via [Composer](https://getcomposer.org/)
```sh
$ composer install
```
Agregar configuraciones en el archivo .env (si es necesario) 
Ambito **Local**, arrancar proyecto con servidor integrado de PHP
```sh
$ php -S localhost:8585 -t public
```

## Rutas

Las rutas estan en el archivo **src/routes.php**
Se asigna el metodo, la ruta, y el controlador a ejecutar con su acción. se recomiendoa asignarles nombres.

``` php 
$group->get('', 'TesteController:home')->setName('test');
```
Mayor información en la documentación de [Slim 4](http://www.slimframework.com/docs/v4/)

## Controladores

Todos los controladores se crean en el directorio **src/Controllers**, se extienden de la clase **Controller**. Ademas se nombraran con la nomenclatura de [PSR-4](https://www.php-fig.org/psr/psr-4/).

Los metodos de accion relacionados a las rutas deberan tener obligatoriamente 2 parametros que son un **ServerRequestInterface** y **ResponseInterface**. Y deben retornar el objeto **ResponseInterface**.

``` php
declare(strict_types = 1);
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class TestController extends Controller {
public function test(Request $request, Response $response, $args)
    {
        return $response;
    }
}
```
Luego de crearse, se deben registrar en el Contenedor de dependencias qué esta en **app/controllers.php**

``` php
$container->set('TestController', function () use ($container) {
        return new \App\Controllers\TestController($container);
});
```
Mayor información en la documentación de [Slim 4](http://www.slimframework.com/docs/v4/)

## Modelos

Todos los modelos se crean en el directorio **src/Models**, se extienden de la clase **Model**. Ademas se nombraran con la nomenclatura de [PSR-4](https://www.php-fig.org/psr/psr-4/). Todo modelo se recomienda desabilitar la funcionalidad de **timestamps**. Y estos no requieren estar registrados en el contenedor de dependencias. 

``` php
declare(strict_types = 1);
namespace App\Models;
class Test extends Model {
    public $timestamps = false;
}
```
Mayor información en la documentación de [Database Laravel](https://laravel.com/docs/7.x/database)

## Vistas

Las vistas se crean en el directorio de **templates** con extension **.twig**. Las vistas se extienden del template base si es necesario.

Y los archivos css y js se alojaran en el directorio de **public/css/** y **public/js/**

Mayor información en la documentación de [Twig 2](https://twig.symfony.com/doc/2.x/)
