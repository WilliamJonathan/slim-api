<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class UsuarioApp extends Model
{
	protected $table = 'usuarioapp';
	protected $fillable = [
		'nome', 'senha', 'email', 'cep',
		'updated_at', 'created_at', 'token'
	];
}
