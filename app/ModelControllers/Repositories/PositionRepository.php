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

	/**
	 * @param bool $withoutIdKey
	 * @return array
	 */
	public function getNameList(bool $withoutIdKey = FALSE): array
	{
		$key = 'id';
		if ($withoutIdKey) {
			$key = 'name';
		}
		return Position::all()->pluck('name', $key)->toArray();
	}
}