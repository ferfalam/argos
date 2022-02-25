<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Zoom\Entities;

use App\ClientDetails;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientHasMeeting
 * 
 * @property int $client_details_id
 * @property int $meeting_idmeeting
 * @property int $id
 * 
 * @property ClientDetail $client_detail
 * @property Meeting $meeting
 *
 * @package App\Models
 */
class ClientHasMeeting extends Model
{
	protected $table = 'client_has_meeting';
	public $timestamps = false;

	protected $casts = [
		'client_details_id' => 'int',
		'meeting_idmeeting' => 'int'
	];

	protected $fillable = [
		'client_details_id',
		'meeting_idmeeting'
	];

	public function client_detail()
	{
		return $this->belongsTo(ClientDetails::class, 'client_details_id');
	}

	public function meeting()
	{
		return $this->belongsTo(Meeting::class, 'meeting_idmeeting');
	}
}
