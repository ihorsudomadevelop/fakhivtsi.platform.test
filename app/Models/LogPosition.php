<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LogPosition
 * @package App\Models
 */
class LogPosition extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 * @var array<int, string>
	 */
	protected $fillable = [
		'user_id',
		'action',
		'field',
		'prev_value',
		'new_value',
		'date',
	];
}
