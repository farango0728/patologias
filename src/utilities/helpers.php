<?php

use Illuminate\Support\Str;
use Slim\Psr7\Response;

if (!function_exists('base_path'))
{
    function base_path($path = '')
    {
        return dirname( __DIR__ ). DIRECTORY_SEPARATOR . ".." .DIRECTORY_SEPARATOR . $path;
    }
}

if (!function_exists('config_path'))
{
    function config_path($path = '')
    {
        return base_path("values/{$path}");
    }
}


if (!function_exists('throw_when'))
{
    function throw_when(bool $fails, string $message, string $exception = Exception::class)
    {
        if (!$fails) return;

        throw new $exception($message);
    }
}



if (!function_exists('config'))
{
    function config($path = null)
    {
        $config = [];
        $folder = scandir(config_path());

        $config_files = array_slice($folder, 2, count($folder));

        foreach ($config_files as $file)
        {
            throw_when(
                Str::after($file, '.') !== 'php',
                'Config files must be .php files'
            );
            data_set($config, Str::before($file, '.php') , require config_path($file));
        }

        return data_get($config, $path);
    }
}


function setAlertError($message)
{
    $_SESSION['errors'] = [$message];
}

function setAlertOk(string $message)
{
    $_SESSION['success'] = [$message];
}

function getBgRandom() : string
{
    $bg = config('instances.bg_login')[rand(0, 3)];
    return $bg;
}

