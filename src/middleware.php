<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "header" => "X-Token",
    "regexp" => "/(.*)/",
    "path" => "/api", /* or ["/api", "/admin"] */
    "ignore" => ["/usuarioclinica/lista/token","/api/v1/usuarioclinica/adiciona", 
    "/api/v1/clinica/gerar/token", "/api/v1/usuarioclinica/adiciona/token", 
    "/api/v1/usuarioclinica/lista/token",
    '/api/v1/usuarioclinica/solicitacaodeconsulta', '/api/v1/usuarioclinica/enviadata',
    '/api/v1/usuarioclinica/adiciona/status', '/api/v1/usuarioclinica/lista', 
    '/api/v1/usuarioapp/cadastro', '/api/v1/usuarioclinica/lista/emailexistente',
    '/api/v1/usuarioclinica/lista/cnpjexistente', '/api/v1/usuarioapp/gerar/token',
    '/api/v1/usuarioapp/adiciona/token','/api/v1/usuarioapp/lista/emailexistente',
    '/api/v1/usuarioapp/lista/token'],
    "secure " => false,
    "secret" =>  $container->get('settings')['secretKey']
]));

$app->add(function($req, $res, $next) {
	$response = $next($req, $res);
	return $response
			->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
