<?php

namespace App\Filament\Resources\ShiftResource\Pages;

use App\Filament\Resources\ShiftResource;
use App\Models\Position;
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
	/*** @var string|NULL */
	protected static ?string $title = 'Зміни (Виїзди)';

	/*** @return array|string[] */
	public function getBreadcrumbs(): array
	{
		return [];
	}

	/*** @return array|Actions\Action[]|Actions\ActionGroup[] */
	protected function getHeaderActions(): array
	{
		if (empty(Position::all())) {
			Notification::make()
				->title('Увага!')
				->body('Ви не можете додати нову зміну: немає доступних позицій')
				->info()
				->send();
			return [];
		} else if (isRoleAdmin() || isRoleOwner()) {
			return [
				Actions\CreateAction::make()
					->label('Додати'),
			];
		} else {
			return [];
		}
	}
}
