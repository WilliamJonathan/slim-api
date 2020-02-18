<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\UsuarioApp;
use \Firebase\JWT\JWT;

// Rotas para produtos
$app->group('/api/v1', function() {

	// Recupera email via post e verifica se já esta cadastrado
	$this->post('/usuarioapp/lista/emailexistente', function($request, $response){
		$dados = $request->getParsedBody();
		$email = $dados['email'] ?? null;

		$usuarioapp = UsuarioApp::where('email', $email)->count();

		if ($usuarioapp >= 1) {
			return $response->withJson([
				//$usuariosclinica
				'status'=> 'email_existente'
			]);
		}else{
			return $response->withJson([
				'status' => 'email_valido'
			]);
		}
		return $response->withJson($usuariosclinica);
	});

	//Adiciona um usuario no banco de dados
	$this->post('/usuarioapp/cadastro', function($request, $response){
		$dados = $request->getParsedBody();
		$usuarioapp = UsuarioApp::create($dados);
		return $response->withJson($usuarioapp);
	});

	// Rotas para gerar token para usuario do app
	$this->post('/usuarioapp/gerar/token', function($request, $response) {
		$dados = $request->getParsedBody();

		$email = $dados['email'] ?? null;
		$senha = $dados['senha'] ?? null;

		$usuarioapp = UsuarioApp::where('email', $email)->first();

		if (!is_null($usuarioapp) && ($senha == $usuarioapp->senha)) {
			//gerar token
			$secretKey = $this->get('settings')['secretKey'];
			$chaveAcesso = JWT::encode($usuarioapp, $secretKey);

			return $response->withJson([
				'chave' => $chaveAcesso,
			]);

		}

		return $response->withJson([
				'chave' => 'erro'
			]);

	});

	//adiciona token na tabela usuarioapp
	$this->post('/usuarioapp/adiciona/token', function($request, $response){
		$dados = $request->getParsedBody();
		$email = $dados['email'] ?? null;
	
		$usuarioapp = UsuarioApp::where('email', $email)->first()
		->update($dados);
		if ($usuarioapp == true) {
			$usuarioapp = UsuarioApp::where('email', $email)->first();
				return $response->withJson([
				$usuarioapp
			]);
		}
		return $response->withJson([
			'chave' => $usuarioapp
		]);
	});

	// Recupera token para o email de login via post
	$this->post('/usuarioapp/lista/token', function($request, $response){
		$dados = $request->getParsedBody();
		$email = $dados['email'] ?? null;
		$senha = $dados['senha'] ?? null;

		$usuarioapp = UsuarioApp::where('email', $email)->first();

		if (!is_null($usuarioapp) && $senha == $usuarioapp->senha) {
			return $response->withJson([
				'status' => $usuarioapp['token']
			]);
		}else{
			return $response->withJson([
				'status' => 'erro'
			]);
		}
		//return $response->withJson($usuariosclinica);
	});

	//recupera login do app e loga usuario
	$this->post('/usuarioapp/autentica/login', function($request, $response) {
		$dados = $request->getParsedBody();

		$email = $dados['email'] ?? null;
		$senha = $dados['senha'] ?? null;

		$usuarioapp = UsuarioApp::where('email', $email)->first();

		if (!is_null($usuarioapp) && $senha == $usuarioapp->senha) {
			$usuarioapp = UsuarioApp::where('email', $email)->first()->update(array('logado'=>$dados['logado']));
			return $response->withJson([
				//$usuarioapp
				'status' => 'verificado'
			]);

		}else{
			return $response->withJson([
				'status' => 'erro'
			]);
		}

	});

	// Recupera email e verifica se ta logado
	$this->post('/usuarioapp/verifica/login', function($request, $response){
		$dados = $request->getParsedBody();
		$email = $dados['email'] ?? null;
		//$logado = $dados['logado'] ?? null;

		$usuarioapp = UsuarioApp::where('email', $email)->first();

		if (!is_null($usuarioapp) && $usuarioapp->logado == 'S') {
			return $response->withJson([
				'status' => 'on'
			]);
		}else{
			return $response->withJson([
				'status' => 'off'
			]);
		}
		//return $response->withJson($usuariosclinica);
	});
});