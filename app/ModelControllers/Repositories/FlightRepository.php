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
		return (int) Flight::query()->latest('date')->max('flight_number');
	}

	public function getForDay(string $date): Collection|array
	{
		return Flight::query()->where('date', $date)->orderBy('flight_number')->get();
	}
}