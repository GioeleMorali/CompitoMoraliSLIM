<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
class NegozioController{
    public function getNegozio(Request $request, Response $response, $args){
        $negozio = new Negozio();
        $response->getBody()->write(json_encode($negozio));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
    public function getArticoli(Request $request, Response $response, $args){
        $negozio = new Negozio();
        if(sizeof($negozio->getArticoli()) == 0 )
        {
            $ErrorMsg = "Errore 404(Non sono presenti articoli non venduti)";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        $negozio = $negozio->getArticoli();
        $response->getBody()->write(json_encode($negozio));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
    public function getIdArticoli(Request $request, Response $response, $args){
        $negozio = new Negozio();
        if($negozio->getIdArticoli($args) == null)
        {
            $ErrorMsg = "Errore 404(Articolo non trovato)";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        $negozio = $negozio->getIdArticoli($args);
        $response->getBody()->write(json_encode($negozio));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
}