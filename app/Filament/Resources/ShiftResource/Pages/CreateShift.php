<?php

namespace App\Filament\Resources\ShiftResource\Pages;

use App\Filament\Resources\ShiftResource;
use App\Models\Shift;
use App\Traits\LogShiftTrait;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

/**
 * Class CreateShift
 * @package App\Filament\Resources\ShiftResource\Pages
 */
class CreateShift extends CreateRecord
{
	use LogShiftTrait;

	/*** @var string */
	protected static string $resource = ShiftResource::class;
	/*** @var bool */
	protected static bool $canCreateAnother = FALSE;

	/*** @return array|string[] */
	public function getBreadcrumbs(): array
	{
		return [];
	}

	/*** @return string */
	public function getTitle(): string
	{
		return 'Нова зміна';
	}

	/*** @return Action */
	protected function getCreateFormAction(): Action
	{
		return parent::getCreateFormAction()
			->label('Створити');
	}

	/*** @return Action */
	protected function getCancelFormAction(): Action
	{
		return parent::getCancelFormAction()
			->label('Відхилити');
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
	 * @param array $data
	 * @return Shift
	 */
	protected function handleRecordCreation(array $data): Shift
	{
		$data['drones']           = array_map(
			fn($drone) => ['serial_number' => $drone['serial_number']],
			$data['drone_items']
		);
		$data['user_id']          = auth()->id();
		$data['watch_time_start'] = '-';
		$data['watch_time_end']   = '-';
		return static::getModel()::create($data);
	}

	/*** @return void */
	protected function afterCreate(): void
	{
		$this->createLogShift($this->record->id, 'create');
	}
}
