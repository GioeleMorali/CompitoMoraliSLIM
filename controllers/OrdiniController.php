<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
class OrdiniController{
    public function getOrdini(Request $request, Response $response, $args){
        $negozio = new Negozio();
        if(sizeof($negozio->getOrdini()) == 0 )
        {
            $ErrorMsg = "Errore 404(Non sono presenti ordini)";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        $negozio = $negozio->getOrdini();
        $response->getBody()->write(json_encode($negozio));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
    public function getIdOrdini(Request $request, Response $response, $args){
        $negozio = new Negozio();
        if($negozio->getIdOrdini($args) == null)
        {
            $ErrorMsg = "Errore 404(Ordine non trovato)";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        $negozio = $negozio->getIdOrdini($args);
        $response->getBody()->write(json_encode($negozio));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
    public function getArticoliVenduti(Request $request, Response $response, $args){
        $negozio = new Negozio();
        if($negozio->getIdOrdini($args) == null)
        {
            $ErrorMsg = "Errore 404(Ordine non trovato)";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        else if(count($negozio->getArticoliVenduti($args)) == 0)
        {
            $ErrorMsg = "Errore 404(Non sono presenti articoli venduti per questo ordine)";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        $negozio = $negozio->getArticoliVenduti($args);
        $response->getBody()->write(json_encode($negozio));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
    public function getArticoliVendutiOrdine(Request $request, Response $response, $args){
        $negozio = new Negozio();
        if($negozio->getIdOrdini($args) == null)
        {
            $ErrorMsg = "Errore 404(Ordine non trovato)";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        else if($negozio->getArticoliVendutiOrdine($args) == null)
        {
            $ErrorMsg = "Errore 404(Articolo venduto non trovato)";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        $negozio = $negozio->getArticoliVendutiOrdine($args);
        $response->getBody()->write(json_encode($negozio));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
    function getVerifica(Request $request, Response $response, $args){
        $negozio = new Negozio();
        if($negozio->getIdOrdini($args) == null)
        {
            $ErrorMsg = "Errore 404(Ordine non trovato)";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        else if($negozio->getVerificaImportoOrdine($args) == false)
        {
            $ErrorMsg = "Importi differenti";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(200);
        }
        $negozio = $negozio->getVerificaImportoOrdine($args);
        $response->getBody()->write(json_encode($negozio));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
    function getSconto(Request $request, Response $response, $args){
        $negozio = new Negozio();
        if($negozio->getSconto($args) == 0)
        {
            $ErrorMsg = "Nessuno sconto disponibile per questo ordine";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(200);
        }
        else if($negozio->getSconto($args) == -1)
        {
            $ErrorMsg = "Sovrapprezzo per questo ordine";
            $response->getBody()->write($ErrorMsg);
            return $response->withHeader("Content-type", "application/json")->withStatus(404);
        }
        $negozio = $negozio->getSconto($args);
        $response->getBody()->write(json_encode("Sconto: ".$negozio));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }
}