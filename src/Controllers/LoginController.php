<?php
declare(strict_types = 1);

namespace App\Controllers;


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class LoginController extends Controller
{

    public function renderLogin(Request $request, Response $response, $args){
        

        return $this->view->render($response, "template/login.twig", ['imagen_info' => $imageInfo]);
    }

    public function login(Request $request, Response $response, $args) : Response{

        $user = $request->getParsedBody()['username'];
        $pass = $request->getParsedBody()['password'];

        //TODO Descomentar la validaciond el password
        $auth = $this->auth->attemp($user,$pass);
       
        if ($auth) {          

                return $response->withHeader('Location', $this->routeParser->urlFor('home'))->withStatus(200);
            
        }

        setAlertError("Usuario o contraseña incorrectos");
        return $response->withHeader('Location', $this->routeParser->urlFor('login'))->withStatus(200);

    }
    public function login1(Request $request, Response $response, $args) : Response{

        $user = $request->getParsedBody()['username'];
        $pass = $request->getParsedBody()['password'];
        //TODO Descomentar la validaciond el password
        $auth = $this->auth->attemp($user,$pass);
        
        if ($auth) {
            
            if ($this->auth->user()['arroba_id']){
                
                $data = $_SESSION['user_am'];
                $data['flag'] = 1;

                return jsonReturn($data, 200);

            } else {
                /* return $response->withHeader('Location', $this->routeParser->urlFor('renderIdentificacionApi'))->withStatus(200); */
                
                $data = array(
                    "flag" => 2,
                    "token" => $this->auth->user()['clave'],
                    "idUser" => $this->auth->user()['id']
                );
                return jsonReturn($data, 200);
            }
        }    
        
                $data = array(
                    'flag' => 0,
                    'message' => 'Usuario o contraseña incorrectos'
                );
                
                return jsonReturn($data, 200);

    }
}