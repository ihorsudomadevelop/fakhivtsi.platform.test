<?php

namespace App\Filament\Resources\PositionResource\Pages;

use App\Filament\Resources\PositionResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Class CreatePosition
 * @package App\Filament\Resources\PositionResource\Pages
 */
class CreatePosition extends CreateRecord
{
	/*** @var string */
	protected static string $resource = PositionResource::class;

	/*** @return array|string[] */
	public function getBreadcrumbs(): array
	{
		return [];
	}

	/*** @return string */
	public function getTitle(): string
	{
		return 'Нова позиція';
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
}
