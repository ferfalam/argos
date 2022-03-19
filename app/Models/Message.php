<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $id
 * @property string|null $subject
 * @property string|null $message
 * @property string|null $attachment
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $from
 * 
 * @property User|null $user
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'messages';

	protected $casts = [
		'from' => 'int'
	];

	protected $fillable = [
		'subject',
		'message',
		'attachment',
		'status',
		'from'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'from');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'messageusers', 'mid', 'uid')
					->withPivot('id', 'status')
					->withTimestamps();
	}
}
