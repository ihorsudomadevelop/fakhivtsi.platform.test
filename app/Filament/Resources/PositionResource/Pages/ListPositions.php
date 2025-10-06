<?php

namespace App\Filament\Resources\PositionResource\Pages;

use App\Filament\Resources\PositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * Class ListPositions
 * @package App\Filament\Resources\PositionResource\Pages
 */
class ListPositions extends ListRecords
{
	/*** @var string */
	protected static string $resource = PositionResource::class;
	/*** @var string|NULL */
	protected static ?string $title = 'Позиції';

	/*** @return array|string[] */
	public function getBreadcrumbs(): array
	{
		return [];
	}

	/*** @return array|Actions\Action[]|Actions\ActionGroup[] */
	protected function getHeaderActions(): array
	{
		return [
			Actions\CreateAction::make()
				->label('Додати'),
		];
	}
}
