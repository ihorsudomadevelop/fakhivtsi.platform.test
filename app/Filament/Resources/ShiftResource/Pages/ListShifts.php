<?php

namespace App\Filament\Resources\ShiftResource\Pages;

use App\Filament\Resources\ShiftResource;
use App\Models\Shift;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

/**
 * Class ListShifts
 * @package App\Filament\Resources\ShiftResource\Pages
 */
class ListShifts extends ListRecords
{
	/*** @var string */
	protected static string $resource = ShiftResource::class;

	/*** @return array|Actions\Action[]|Actions\ActionGroup[] */
	protected function getHeaderActions(): array
	{
		if (empty(Shift::all())) {
			Notification::make()
				->title('Увага!')
				->body('Ви не можете додати нову зміну: немає доступних позицій')
				->info()
				->send();
			return [];
		}
		return [
			Actions\CreateAction::make(),
		];
	}
}
