<?php
declare(strict_types = 1);

use App\utilities\CsrfExtension;
use App\utilities\FlashExtension;
use App\utilities\HideSegmentMailExtension;
use Slim\App;
use Slim\Views\Twig;
use Symfony\Bridge\Twig\Mime\BodyRenderer;
use Twig\Loader\FilesystemLoader;

return function (App $app) {

    $container = $app->getContainer();

    $container->set('view', function () use ($container) {

        $settings = $container->get('settings')['views'];

        $loader = new FilesystemLoader($settings['path']);

        $twig = new Twig($loader, $settings['settings']);

        $twig->addExtension(new CsrfExtension($container->get('csrf')));
        $twig->addExtension(new HideSegmentMailExtension());
        $function = new \Twig\TwigFunction('clear', function ($type){
            unset($_SESSION[$type]);
        });
        $twig->getEnvironment()->addFunction($function);
        $function = new \Twig\TwigFunction('getBgRandom', function (){
            return getBgRandom();
        });
        $twig->getEnvironment()->addFunction($function);
        $twig->getEnvironment()->addGlobal('auth', $container->get('auth'));
        $twig->getEnvironment()->addGlobal('base_path', env("Base_Path") );
        $twig->getEnvironment()->addGlobal('errors', $_SESSION['errors'] ?? "" );
        $twig->getEnvironment()->addGlobal('success', $_SESSION['success'] ?? "" );

        return $twig;

    });


    $container->set("bodyrender", function () use($container) {
        return new BodyRenderer($container->get('view')->getEnvironment());
    });
};
