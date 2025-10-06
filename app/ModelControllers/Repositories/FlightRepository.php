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
	 * @param int $shiftId
	 * @return int
	 */
	public function getLastFlightNumber(int $shiftId): int
	{
		$lastDateFlightModel = Flight::where('shift_id', '=', $shiftId)
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
	 * @param int         $shiftId
	 * @param string|NULL $date
	 * @return Collection|array
	 */
	public function getForDay(int $shiftId, ?string $date = NULL): Collection|array
	{
		//TODO get last shift position (if Position A have 3 flights and Poistion B have 0, choose A)
		//Night shifts consist of 2 dates !!!
		$query = Flight::query()->where('shift_id', '=', $shiftId)->latest('date')->orderBy('flight_number', 'desc');
		$date  ??= $query->value('date');
		return Flight::query()
			->where('date', $date)
			->orderBy('flight_number')
			->get();
	}
}