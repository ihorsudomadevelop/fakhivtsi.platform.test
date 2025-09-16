<?php

namespace App\Filament\Resources\FlightResource\Pages;

use App\Filament\Resources\FlightResource;
use App\Models\Flight;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Throwable;

/**
 * Class CreateFlight
 * @package App\Filament\Resources\FlightResource\Pages
 */
class CreateFlight extends CreateRecord
{
	/*** @var string */
	protected static string $resource = FlightResource::class;

	/**
	 * @param array $data
	 * @return Flight
	 */
	protected function handleRecordCreation(array $data): Flight
	{
		try {
			$flightNumber = flightController()->getLastFlightNumber() + 1;
		} catch (Throwable) {
			$flightNumber = 1;
		}
		$data['date']          = now()->format('Y-m-d');
		$data['call_sign']     = 'Фахівці';
		$data['flight_number'] = $flightNumber;
		return static::getModel()::create($data);
	}
}
