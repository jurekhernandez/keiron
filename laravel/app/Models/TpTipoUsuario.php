<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TpTipoUsuario
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property Collection|TbUsuario[] $tb_usuarios
 *
 * @package App\Models
 */
class TpTipoUsuario extends Model
{
	protected $table = 'tp_tipo_usuario';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function tb_usuarios()
	{
		return $this->hasMany(TbUsuario::class, 'id_tipo_usuario');
	}
}
