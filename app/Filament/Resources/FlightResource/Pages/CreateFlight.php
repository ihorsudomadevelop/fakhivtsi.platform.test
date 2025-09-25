<?php

namespace App\Filament\Resources\FlightResource\Pages;

use App\Filament\Resources\FlightResource;
use App\Models\Flight;
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
			$flightNumber = flightController()->getLastFlightNumber();
			if ($flightNumber !== 1) {
				$flightNumber += 1;
			}
		} catch (Throwable) {
			$flightNumber = 1;
		}
		$data['date']                = now()->format('Y-m-d');
		$data['call_sign']           = 'Фахівці';
		$data['flight_number']       = $flightNumber;
		$data['drone_serial_number'] = '-';
		$ammunitionData              = [];
		foreach ($data['ammunition_items'] as $ammunitionItem) {
			$ammunitionData[] = ['title' => $ammunitionItem['ammunition'], 'quantity' => $ammunitionItem['quantity']];
		}
		$data['ammunition'] = $ammunitionData;
		$data['pilot']      = 'Айтішнік';
		return static::getModel()::create($data);
	}
}
