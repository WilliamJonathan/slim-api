<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Clase que envia para o paciente a agenda de horario
 protected $primaryKey = 'itm_codigo';
 */
class ConsultaConfirmada extends Model
{
	protected $table = 'consultasconfirmadas';
	protected $fillable = [
		'id_clinica','id_paciente','nomeClinica','DataConsulta', 'tipoConsulta', 'telefonePaciente',
		'nomePaciente','updated_at', 'created_at'
	];
}
