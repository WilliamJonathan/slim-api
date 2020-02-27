<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\SolicitacaoConsulta;
use App\Models\ConsultaAguardaConfirmar;
use App\Models\ConsultaConfirmada;
use \Firebase\JWT\JWT;
// Rotas para produtos
$app->group('/api/v1', function() {
	//Adiciona uma solicitação de consulta no banco de dados. Colocar na rota app depois
	$this->post('/usuarioapp/solicitaconsulta', function($request, $response){
		$dados = $request->getParsedBody();
		$usuariosclinica = SolicitacaoConsulta::create($dados);
		return $response->withJson($usuariosclinica);
	});

	//busca uma solicitação de consulta no banco de dados para o usuario da clinica logado
	$this->get('/usuarioclinica/lista/consultas/{codigo}', function($request, $response, $args){
		$usuariosclinica = SolicitacaoConsulta::where('id_clinica', '=', $args['codigo'])
		->orderBy('updated_at', 'DESC')->get();
		return $response->withJson($usuariosclinica);
	});

	//adiciona (pendente) no status na tabela solicitação de consulta
	$this->post('/usuarioclinica/adiciona/status', function($request, $response){
		$dados = $request->getParsedBody();
		$id = $dados['id'] ?? null;
		
		$usuariosclinica = SolicitacaoConsulta::where('id', $id)->first()
		->update($dados);
		return $response->withJson($usuariosclinica);
	});

	//busca uma consulta pendente de confirmação
	$this->get('/usuarioclinica/lista/consultasppendentes/{codigo}', function($request, $response, $args){
		$usuariosclinica = ConsultaAguardaConfirmar::where('id_clinica', '=', $args['codigo'])
		->orderBy('updated_at', 'DESC')->get();
		return $response->withJson($usuariosclinica);
	});

	//busca uma consulta confirmada no banco de dados
	$this->get('/usuarioclinica/lista/consultasconfirmadas/{codigo}', function($request, $response, $args){
		$usuariosclinica = ConsultaConfirmada::where('id_clinica', '=', $args['codigo'])
		->orderBy('updated_at', 'DESC')->get();
		return $response->withJson($usuariosclinica);
	});

	//envia sugestão de horario para o paciente
	$this->post('/usuarioclinica/enviadata', function($request, $response){
		$dados = $request->getParsedBody();
		$usuariosclinica = ConsultaAguardaConfirmar::create($dados);
		return $response->withJson($usuariosclinica);
	});

});