<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\UsuarioClinica;
use App\Models\SolicitacaoConsulta;
use \Firebase\JWT\JWT;
// Rotas para produtos
$app->group('/api/v1', function() {

	//adiciona uma nova clinica no banco de dados
	$this->post('/usuarioclinica/adiciona', function($request, $response){
		$dados = $request->getParsedBody();
		$usuariosclinica = Usuarioclinica::create($dados);
		return $response->withJson($usuariosclinica);
	});

	//adiciona token na tabela usuarioClinica
	$this->post('/usuarioclinica/adiciona/token', function($request, $response){
		$dados = $request->getParsedBody();
		$email = $dados['email'] ?? null;
		//$usuariosclinica = Usuarioclinica::create($dados);
		$usuariosclinica = Usuarioclinica::where('email', $email)->first()
		->update($dados);
		return $response->withJson($usuariosclinica);
	});

	// Rotas para gerar token para usuario da clinica
	$this->post('/clinica/gerar/token', function($request, $response) {
		$dados = $request->getParsedBody();

		$email = $dados['email'] ?? null;
		$senha = $dados['senha'] ?? null;

		$usuariosclinica = Usuarioclinica::where('email', $email)->first();

		if (!is_null($usuariosclinica) && (md5($senha) === $usuariosclinica->senha)) {
			//gerar token
			$secretKey = $this->get('settings')['secretKey'];
			$chaveAcesso = JWT::encode($usuariosclinica, $secretKey);

			return $response->withJson([
				'chave' => $chaveAcesso,
			]);

			/*return $response->withJson([
				'status' => 'sucesso'
			]);*/
		}

		return $response->withJson([
				'status' => 'erro'
			]);

	});

	//recupera login da clinica e loga usuario
	$this->post('/autentica/login', function($request, $response) {
		$dados = $request->getParsedBody();

		$email = $dados['email'] ?? null;
		$senha = $dados['senha'] ?? null;

		$usuariosclinica = Usuarioclinica::where('email', $email)->first();

		if (!is_null($usuariosclinica) && (md5($senha) === $usuariosclinica->senha)) {
			//recuperar dados

			return $response->withJson([
				$usuariosclinica
			]);

		}else{
			return $response->withJson([
				'status' => 'erro'
			]);
		}

	});

	// Recupera email via post e verifica se já esta cadastrado
	$this->post('/usuarioclinica/lista/emailexistente', function($request, $response){
		$dados = $request->getParsedBody();
		$email = $dados['email'] ?? null;

		$usuariosclinica = Usuarioclinica::where('email', $email)->count();

		if ($usuariosclinica >= 1) {
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

	// Recupera CNPJ via post e verifica se já esta cadastrado
	$this->post('/usuarioclinica/lista/cnpjexistente', function($request, $response){
		$dados = $request->getParsedBody();
		$cnpj = $dados['cnpj'] ?? null;

		$usuariosclinica = Usuarioclinica::where('cnpj', $cnpj)->count();

		if ($usuariosclinica >= 1) {
			return $response->withJson([
				//$usuariosclinica
				'status'=> 'cnpj_existente'
			]);
		}else{
			return $response->withJson([
				'status' => 'cnpj_valido'
			]);
		}
		return $response->withJson($usuariosclinica);
	});

	// Recupera token para o email de login via post
	$this->post('/usuarioclinica/lista/token', function($request, $response){
		$dados = $request->getParsedBody();
		$email = $dados['email'] ?? null;
		$senha = $dados['senha'] ?? null;

		$usuariosclinica = Usuarioclinica::where('email', $email)->first();

		if (!is_null($usuariosclinica) && (md5($senha) === $usuariosclinica->senha)) {
			return $response->withJson([
				$usuariosclinica
			]);
		}else{
			return $response->withJson([
				'status' => 'erro'
			]);
		}
		//return $response->withJson($usuariosclinica);
	});

	// Recupera objeto clinica para um determinado id
	$this->get('/usuarioclinica/lista/{codigo}', function($request, $response, $args){
		$usuariosclinica = Usuarioclinica::where('id', '=', $args['codigo'])
		->orwhere('nome_fantasia', 'like', '%'.$args['codigo'].'%')
		->orwhere('ocupacao', 'like', '%'.$args['codigo'].'%')->get();
		return $response->withJson($usuariosclinica);
	});
});