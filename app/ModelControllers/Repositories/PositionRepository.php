<?php

namespace App\ModelControllers\Repositories;

use App\Models\Position;

/**
 * Class PositionRepository
 * @package App\ModelControllers\Repositories
 */
class PositionRepository
{
	/**
	 * @param int $id
	 * @return Position
	 */
	public function findById(int $id): Position
	{
		return Position::where('id', '=', $id)->first();
	}

	/*** @return array */
	public function getNameList(): array
	{
		return Position::all()->pluck('name', 'id')->toArray();
	}
}