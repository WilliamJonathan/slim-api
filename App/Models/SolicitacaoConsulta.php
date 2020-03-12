<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Clase que adiciona uma SOLICITAÇÃO de consulta a ser confirmada no banco de dados
 protected $primaryKey = 'itm_codigo';
 */
class SolicitacaoConsulta extends Model
{
	protected $table = 'solicitacaoConsulta';
	protected $fillable = [
		'id_cliente','nome_cliente', 'id_clinica', 'telefone_cliente', 'tipo_consulta',
		'hora_preferencia', 'data_consulta', 'foraPeriodo', 'updated_at', 'created_at','status_consulta'
	];
}



