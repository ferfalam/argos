<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Zoom\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MeetingHasUser
 * 
 * @property int $meeting_idmeeting
 * @property int $users_id
 * @property int $meeting_has_user_id
 * 
 * @property Meeting $meeting
 * @property User $user
 *
 * @package App\Models
 */
class MeetingHasUser extends Model
{
	protected $table = 'meeting_has_users';
	protected $primaryKey = 'meeting_has_user_id';
	public $timestamps = false;

	protected $casts = [
		'meeting_idmeeting' => 'int',
		'users_id' => 'int'
	];

	protected $fillable = [
		'meeting_idmeeting',
		'users_id'
	];

	public function meeting()
	{
		return $this->belongsTo(Meeting::class, 'meeting_idmeeting');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
