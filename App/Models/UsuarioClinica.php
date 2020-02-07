<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class Usuarioclinica extends Model
{
	protected $table = 'usuariosclinica';
	protected $fillable = [
		'nome_fantasia', 'email', 'cnpj', 'telefone', 'cep', 'rua','num_local', 'bairro', 'cidade', 'uf',
		'senha', 'ocupacao', 'updated_at', 'created_at', 'token',
	];

}

/**
 * 
 *
class ConsultaMarcada extends Model
{
	protected $table = 'consultas_marcadas';
	protected $fillable = [
		'nome_cliente', 'telefone_cliente', 'tipo_consulta', 'updated_at', 'created_at'
	];
}
*/