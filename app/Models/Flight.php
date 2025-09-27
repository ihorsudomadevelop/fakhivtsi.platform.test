<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Flight
 * @property string      date
 * @property string      call_sign
 * @property string      position
 * @property integer     flight_number
 * @property string      drone_serial_number
 * @property string      target
 * @property string      coordinates
 * @property string      flight_time_start
 * @property string      flight_time_end
 * @property array       ammunition
 * @property string      target_status
 * @property string|NULL impressed
 * @property string      pilot
 * @package App\Models
 */
class Flight extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 * @var array<int, string>
	 */
	protected $fillable = [
		'date',
		'call_sign',
		'position',
		'flight_number',
		'drone_serial_number',
		'target',
		'coordinates',
		'flight_time_start',
		'flight_time_end',
		'ammunition',
		'target_status',
		'pilot',
	];

	/*** @var string[] */
	protected $casts = ['ammunition' => 'array'];

	public function getAmmunition(): array
	{
		return $this->ammunition;
	}

	public function setAmmunition(array $ammunition): void
	{
		$this->ammunition = $ammunition;
	}
}
