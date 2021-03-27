<?php
namespace App\Controllers;


use App\Models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UserController extends Controller
{
    
    
    public function all(Request $request, Response $response)
    {
    
        $orders = User::data();
        
        $newResponse = $response->withHeader('Content-type', 'application/json');
        return $newResponse->withJson($orders, 200);
    }

    public function add(Request $request, Response $response)
    {
        
        return $this->view->render($response, "content_form_add.twig", ["form" => "orden.twig", "module_name" => ["Cursos#admin.courses", "Agregar curso"], "programs" => $programs, "menu_active" => '',  "institutions" => $institutions]);
    }

    public function user(Request $request, Response $response, $args)
    {
       
        return $this->container->get("view")->render($response, "user.twig");

    }
    
}