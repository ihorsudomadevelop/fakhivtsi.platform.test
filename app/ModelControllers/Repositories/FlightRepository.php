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
	/*** @return int */
	public function getLastFlightNumber(): int
	{
		$lastDateFlightModel = Flight::whereDate('date', now('Europe/Kyiv')->toDateString())
			->latest('date')
			->orderByDesc('flight_number')
			->first();
		if ($lastDateFlightModel) {
			return (int) $lastDateFlightModel->flight_number;
		} else {
			return 1;
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