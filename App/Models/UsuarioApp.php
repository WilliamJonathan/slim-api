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
		'nome', 'sobrenome', 'telefone', 'email', 'senha', 'token', 'updated_at', 'created_at','logado'
	];
}
