<?php
namespace App\Controllers;


use App\Models\Order;
use App\Models\Resultados;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class StudyController extends Controller
{
    
    
    public function all(Request $request, Response $response)
    {
    
        $orders = Order::all();
        
        $newResponse = $response->withHeader('Content-type', 'application/json');
        return $newResponse->withJson($orders, 200);
    }

    public function study(Request $request, Response $response, $args)
    {
       
        return $this->container->get("view")->render($response, "study.twig");

    }

    public function add(Request $request, Response $response)
    {
       
        
        $resultados = new Resultados();
        $resultados->id_orden = $request->getParam('orden');
        $resultados->intensidad = $request->getParam('respuestaPregunta')[1];
        $resultados->volumen_agua = $request->getParam('respuestaPregunta')[3];
        $resultados->volumen_total = $request->getParam('respuestaPregunta')[4];
        $resultados->hallazgo = $request->getParam('orden');
        $resultados->usuario = $_SESSION['user_am']['id'];
        $resultados->save();

        /* $ordenEstudio = Order::where('orden.id_orden', '=', $request->getParam('orden'))->first();
        $ordenEstudio->active = 0;
        $ordenEstudio->save(); */
 
        
        $estudio = Resultados::where('id_orden', '=', $request->getParam('orden'))->get();
        
        $data = array(
                'id_paciente' => $paciente = $estudio[0]->paciente[0]->id_paciente,
                'fecha_lectura' => $estudio[0]->fecha_creacion,
                'id_orden' => $estudio[0]->id_orden,
                'usuario_lectura' => $_SESSION['user_am']['id'],
                'intensidad_media' => $estudio[0]->intensidad,
                'birads' => 1,
                'vol_tot' => $estudio[0]->volumen_total,
                'vol_agua' => $estudio[0]->volumen_agua,
                'perc_agua' => $estudio[0]->volumen_agua/$estudio[0]->volumen_total,
                'hallazgos' => $estudio[0]->hallazgo,        
        );

        $newResponse = $response->withHeader('Content-type', 'application/json');
        return $newResponse->withJson($data, 200);

    }
    
}