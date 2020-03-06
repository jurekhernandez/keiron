<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
/*
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
*/

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
/**
 * Class TbUsuario
 *
 * @property int $id
 * @property int $id_tipo_usuario
 * @property string $nombre
 * @property string $mail
 * @property string $pass
 *
 * @property TpTipoUsuario $tp_tipo_usuario
 * @property Collection|TbTicket[] $tb_tickets
 *
 * @package App\Models
 */
class TbUsuario extends Authenticatable
{
    use Notifiable ,HasApiTokens, SoftDeletes;
    const DELETED_AT = 'fecha_eliminacion';
	protected $table = 'tb_usuarios';
	public $timestamps = false;

	protected $casts = [
		'id_tipo_usuario' => 'int'
	];

	protected $fillable = [
		'id_tipo_usuario',
		'nombre',
		'mail',
		'pass'
    ];

    protected $hide=[
        'pass'
    ];

    public function setPassAttribute($value){
		//$this->attributes['clave'] =  Hash::make($value);
		$this->attributes['pass'] =  bcrypt($value);
    }

    public function getAuthPassword()
    {
        return $this->pass;
    }

	public function tp_tipo_usuario()
	{
		return $this->belongsTo(TpTipoUsuario::class, 'id_tipo_usuario');
	}

	public function tb_tickets()
	{
		return $this->hasMany(TbTicket::class, 'id_user');
	}
}
