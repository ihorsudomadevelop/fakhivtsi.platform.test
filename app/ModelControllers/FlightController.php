<?php

namespace App\ModelControllers;

use App\ModelControllers\Repositories\FlightRepository;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class FlightController
 * @package App\ModelControllers
 */
class FlightController
{

	/*** @var FlightRepository */
	public FlightRepository $repo;

	/**
	 * FlightController constructor.
	 * @param FlightRepository $repo
	 */
	public function __construct(FlightRepository $repo)
	{
		$this->repo = $repo;
	}

	/*** @return int */
	public function getLastFlightNumber(): int
	{
		return $this->repo->getLastFlightNumber();
	}

	/**
	 * @param string|NULL $date
	 * @return Collection|array
	 */
	public function getForDay(?string $date = NULL): Collection|array
	{
		return $this->repo->getForDay($date);
	}
}