<?php
namespace App\Controllers;
use DateTime;

use App\Models\Order;
use App\Models\Preguntas;
use App\Models\Multiples;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class OrderController extends Controller
{
    
    
    public function all(Request $request, Response $response)
    {
    
        $orders = Order::all();
        
        $newResponse = $response->withHeader('Content-type', 'application/json');
        return $newResponse->withJson($orders, 200);
    }

    public function show(Request $request, Response $response, $args)
    {
        $orders = Order::get();
        $preguntas = Preguntas::select(['id_pregunta', 'descripcion', 'tipo'])->get();
        $multiplesOpciones = Multiples::select(['id_pregunta', 'id_opcion', 'descripcion'])->get();

        $paciente = $orders[0]->paciente;

        $cumpleanos = new DateTime($paciente[0]->fecha_nacimiento);
        $hoy = new DateTime();
        $annos = $hoy->diff($cumpleanos);
        $edad = $annos->y;

        return $this->container->get("view")->render($response, "form.twig", ["nombre" => $paciente[0]->nombre.' '.$paciente[0]->apellido, "autorizacion" => $orders[0]->autorizacion, 'edad'=> $edad, 'preguntas' => $preguntas, 'multiples' => $multiplesOpciones, 'orden' => $orders[0]->id_orden ]);
        
        /* $newResponse = $response->withHeader('Content-type', 'application/json');
        return $newResponse->withJson($multiplesOpciones->id_pregunta, 200); */
    }
    
}