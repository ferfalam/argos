<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Zoom\Entities;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Meeting
 * 
 * @property int $idmeeting
 * @property string|null $title
 * @property string|null $description
 * @property Carbon|null $start_date_time
 * @property Carbon|null $end_date_time
 * @property string|null $label
 * @property int $room_idroom
 * @property string|null $status
 * 
 * @property Room $room
 * @property Collection|ClientHasMeeting[] $client_has_meetings
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Meeting extends Model
{
	protected $table = 'meeting';
	protected $primaryKey = 'idmeeting';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'idmeeting' => 'int',
		'room_idroom' => 'int'
	];

	protected $dates = [
		'start_date_time',
		'end_date_time'
	];

	protected $fillable = [
		'title',
		'description',
		'start_date_time',
		'end_date_time',
		'label',
		'room_idroom',
		'status'
	];

	public function room()
	{
		return $this->belongsTo(Room::class, 'room_idroom');
	}

	public function client_has_meetings()
	{
		return $this->hasMany(ClientHasMeeting::class, 'meeting_idmeeting');
	}
	public function user_has_meetings()
	{
		return $this->hasMany(MeetingHasUser::class, 'meeting_idmeeting');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'meeting_has_users', 'meeting_idmeeting', 'users_id')
					->withPivot('meeting_has_user_id');
	}
}
