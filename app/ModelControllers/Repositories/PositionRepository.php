<?php

namespace App\ModelControllers\Repositories;

use App\Models\Position;

/**
 * Class PositionRepository
 * @package App\ModelControllers\Repositories
 */
class PositionRepository
{
	/*** @return array */
	public function getNameList(): array
	{
		return Position::all()->pluck('name', 'name')->toArray();
	}
}