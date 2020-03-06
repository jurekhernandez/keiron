<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class TbTicket
 *
 * @property int $id
 * @property int $id_user
 * @property bool $ticket_pedido
 *
 * @property TbUsuario $tb_usuario
 *
 * @package App\Models
 */
class TbTicket extends Model
{
    use SoftDeletes;
    const DELETED_AT = 'fecha_eliminacion';
	protected $table = 'tb_ticket';
	public $timestamps = false;

	protected $casts = [
		'id_user' => 'int',
		'ticket_pedido' => 'bool'
	];

	protected $fillable = [
		'id_user',
        'ticket_pedido',
        'contenido'
	];

	public function tb_usuario()
	{
		return $this->belongsTo(TbUsuario::class, 'id_user');
	}
}
