<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * Clase que envia para o paciente a agenda de horario
 protected $primaryKey = 'itm_codigo';
 */
class ConsultaAguardaConfirmar extends Model
{
	protected $table = 'ConsultaAguardaConfirmar';
	protected $fillable = [
		'id_clinica','id_paciente','nomeClinica','DataConsulta', 'tipoConsulta', 'telefonePaciente',
		'updated_at', 'created_at', 'nomePaciente'
	];
}
