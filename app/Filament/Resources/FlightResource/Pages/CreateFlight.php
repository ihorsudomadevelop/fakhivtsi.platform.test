<?php

namespace App\Filament\Resources\FlightResource\Pages;

use App\Filament\Resources\FlightResource;
use App\Models\Flight;
use App\Models\Shift;
use App\ObjectValues\ShiftStatus;
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

	/*** @return array|string[] */
	public function getBreadcrumbs(): array
	{
		return [];
	}

	/*** @return string */
	public function getTitle(): string
	{
		return 'Новий політ';
	}

	/**
	 * @param array $data
	 * @return Flight
	 */
	protected function handleRecordCreation(array $data): Flight
	{
		/*** @var Shift|NULL $shift */
		$shift = Shift::query()->where('user_id', '=', auth()->id())->where('status', '=', ShiftStatus::ACTIVE)->first();
		//$position     = positionController()->findById($data['position']);
		$flightNumber = $this->getNextFlightNumber($shift->id);
		$data         = array_merge($data, [
			'date'                => now()->format('Y-m-d'),
			'call_sign'           => 'Фахівці',
			'shift_id'            => $shift->id,
			'position_id'         => $shift->position_id,
			'flight_number'       => $flightNumber,
			'drone_serial_number' => '-',
			'ammunition'          => $this->formatAmmunition($data['ammunition_items'] ?? []),
			'pilot'               => 'Айтішнік',
		]);
		return static::getModel()::create($data);
	}

	/*** @return string */
	protected function getRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}

	/*** @return string */
	protected function getCreatedRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}

	/**
	 * @param int $shiftId
	 * @return int
	 */
	protected function getNextFlightNumber(int $shiftId): int
	{
		try {
			$lastFlightNumber = flightController()->getLastFlightNumber($shiftId);
			return $lastFlightNumber > 0 ? $lastFlightNumber + 1 : 1;
		} catch (Throwable) {
			return 1;
		}
	}

	/**
	 * @param array $items
	 * @return array
	 */
	protected function formatAmmunition(array $items): array
	{
		return array_map(function($item) {
			return [
				'title'    => $item['ammunition'] ?? '-',
				'quantity' => $item['quantity'] ?? 0,
			];
		}, $items);
	}
}
