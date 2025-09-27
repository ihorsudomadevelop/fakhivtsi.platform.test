<?php

namespace App\Filament\Resources\ShiftResource\Pages;

use App\Filament\Resources\ShiftResource;
use App\Models\Shift;
use Filament\Resources\Pages\CreateRecord;

/**
 * Class CreateShift
 * @package App\Filament\Resources\ShiftResource\Pages
 */
class CreateShift extends CreateRecord
{
	/*** @var string */
	protected static string $resource = ShiftResource::class;

	/**
	 * @param array $data
	 * @return Shift
	 */
	protected function handleRecordCreation(array $data): Shift
	{
		$data['drones'] = array_map(
			fn($drone) => ['serial_number' => $drone['serial_number']],
			$data['drone_items']
		);
		return static::getModel()::create($data);
	}
}
