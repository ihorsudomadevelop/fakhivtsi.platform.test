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
		'position',
		'drones',
		'shift_start_at',
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
