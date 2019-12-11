<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->options('/{routes:.+}', function($request, $response, $args)
{
	return $response;
});

// Routes
//require __DIR__ . '/routes/autenticacao.php';
require __DIR__ . '/routes/usuarioClinica.php';
require __DIR__ . '/routes/usuarioApp.php';
require __DIR__ . '/routes/consultaMarcada.php';

// Catch-all route to serve a 404 Not Found page if none of the routes match
// NOTE: make sure this route is defined last
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});




/*$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});*/
