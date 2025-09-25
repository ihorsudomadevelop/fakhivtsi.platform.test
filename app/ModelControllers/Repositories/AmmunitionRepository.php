<?php

namespace App\ModelControllers\Repositories;

use App\Models\Ammunition;

/**
 * Class AmmunitionRepository
 * @package App\ModelControllers\Repositories
 */
class AmmunitionRepository
{
	/*** @return array */
	public function getTitleList(): array
	{
		return Ammunition::all()->pluck('title', 'title')->toArray();
	}
}