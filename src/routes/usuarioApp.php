<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\UsuarioApp;
use \Firebase\JWT\JWT;

// Rotas para produtos
$app->group('/api/v1', function() {

	//Adiciona um usuario no banco de dados
	$this->post('/usuarioapp/cadastro', function($request, $response){
		$dados = $request->getParsedBody();
		$usuarioapp = UsuarioApp::create($dados);
		return $response->withJson($usuarioapp);
	});

	//recupera login do app e loga usuario
	$this->post('/usuarioapp/autentica/login', function($request, $response) {
		$dados = $request->getParsedBody();

		$email = $dados['email'] ?? null;
		$senha = $dados['senha'] ?? null;

		$usuarioapp = UsuarioApp::where('email', $email)->first();

		if (!is_null($usuarioapp) && ($senha) == $usuarioapp->senha) {
			//recuperar dados

			return $response->withJson([
				$usuarioapp
			]);

		}else{
			return $response->withJson([
				'status' => 'erro'
			]);
		}

	});
});