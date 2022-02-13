<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\Zoom\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Room
 * 
 * @property int $idroom
 * @property string|null $name
 * @property string|null $location
 * @property string|null $capacity
 * 
 * @property Collection|Meeting[] $meetings
 *
 * @package App\Models
 */
class Room extends Model
{
	protected $table = 'room';
	protected $primaryKey = 'idroom';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'location',
		'capacity'
	];

	public function meetings()
	{
		return $this->hasMany(Meeting::class, 'room_idroom');
	}
}
