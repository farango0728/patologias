<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Models\MessageImage;
use App\Models\RedesSociales;
use App\Models\User;
use App\Controllers\ProfileController;
use App\Controllers\LinkedIn;
use App\utilities\MoodleWSImpl;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

use App\Models\Categorias;


class HomeController extends Controller
{

    public function home(Request $request, Response $response, $args)
    {
       
        return $this->container->get("view")->render($response, "index.twig");

    }

    public function logout(Request $request, Response $response)
    {
        $this->auth->logout();
        return $this->view->render($response, 'logout.twig');
    }

    public function orden(Request $request, Response $response, $args)
    {
       
        return $this->container->get("view")->render($response, "orden.twig");

    }
}
