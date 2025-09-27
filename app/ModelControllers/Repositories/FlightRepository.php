<?php

namespace App\ModelControllers\Repositories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class FlightRepository
 * @package App\ModelControllers\Repositories
 */
class FlightRepository
{
	/**
	 * @param int $positionId
	 * @return int
	 */
	public function getLastFlightNumber(int $positionId): int
	{
		$lastDateFlightModel = Flight::where('position_id', '=', $positionId)
			->latest('date')
			->orderByDesc('flight_number')
			->first();
		if ($lastDateFlightModel) {
			return (int) $lastDateFlightModel->flight_number;
		} else {
			return 0;
		}
	}

	/**
	 * @param string|NULL $date
	 * @return Collection|array
	 */
	public function getForDay(?string $date = NULL): Collection|array
	{
		$date ??= Flight::query()->latest('date')->value('date');
		return Flight::query()
			->where('date', $date)
			->orderBy('flight_number')
			->get();
	}
}