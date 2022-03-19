<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Messageuser
 * 
 * @property int $id
 * @property int|null $mid
 * @property int|null $uid
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Message|null $message
 * @property User|null $user
 *
 * @package App\Models
 */
class Messageuser extends Model
{
	protected $table = 'messageusers';

	protected $casts = [
		'id' => 'int',
		'mid' => 'int',
		'uid' => 'int'
	];

	protected $fillable = [
		'mid',
		'uid',
		'status'
	];

	public function message()
	{
		return $this->belongsTo(Message::class, 'mid');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'uid');
	}
}
