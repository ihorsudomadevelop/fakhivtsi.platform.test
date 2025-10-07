<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Shift
 * @property array|NULL drones
 * @package App\Models
 */
class Shift extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'user_id',
		'position_id',
		'crew',
		'drones',
		'shift_start_at',
		'watch_time_start',
		'watch_time_end',
		'status',
	];

	/*** @var string[] */
	protected $casts = ['drones' => 'array'];

	/*** @return array|NULL */
	public function getDrones(): ?array
	{
		return $this->drones;
	}

	/**
	 * @param array|NULL $drones
	 * @return void
	 */
	public function setDrones(?array $drones): void
	{
		$this->drones = $drones;
	}
}
