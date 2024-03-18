<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
function autoload($className)
{
    $paths=['/', '/controllers', '/views', '/models'];
    foreach($paths as $path)
    {
        $file = __DIR__.$path."/$className.php";
        if(file_exists($file))
        {
            require_once($file);
            break;
        }
    }
}
spl_autoload_register("autoload");
$app = AppFactory::create();

$app->get("/negozio", "NegozioController:getNegozio");
$app->get("/articoli", "NegozioController:getArticoli");
$app->get("/articoli/{id}", "NegozioController:getIdArticoli");

$app->get("/ordini", "OrdiniController:getOrdini");
$app->get("/ordini/{numero_ordine}", "OrdiniController:getIdOrdini");
$app->get("/ordini/{numero_ordine}/articoli_venduti", "OrdiniController:getArticoliVenduti");
$app->get("/ordini/{numero_ordine}/articoli_venduti/{id}", "OrdiniController:getArticoliVendutiOrdine");

$app->get("/ordini/{numero_ordine}/verifica", "OrdiniController:getVerifica");
$app->get("/ordini/{numero_ordine}/sconto", "OrdiniController:getSconto");

$app->run();
