<?php
namespace App\Controllers;


use App\Models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class LogicController extends Controller
{
    
    
    public function array1(Request $request, Response $response)
    {
    
        $data = array(-2, 1, -3, 4, -1 , 2 , 1 , -5 , 4);
        
        $posicion = array_search(4, $data);
        $finPosicion = $posicion + 4;
        $acumulado = 0;
        $arrayResul = [];
        while($posicion <  $finPosicion){
            $acumulado += $data[$posicion];
            array_push($arrayResul , $data[$posicion]);
            $posicion++;
        }     
        
        $resultado = array('array' => $data, 'valores'=> $arrayResul , 'resultado' => $acumulado);

        $number = 5;
        $i = 1;
        while($i < $number){
            $i = $i * 2;
        }
        echo $i;

        return $this->view->render($response, "logic.twig", ['data' => $data, 'result' => $acumulado, 'arraySum' => $arrayResul]);
        
    }

}