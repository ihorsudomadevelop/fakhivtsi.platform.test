<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PositionResource\Pages;
use App\Filament\Resources\PositionResource\RelationManagers;
use App\Models\Position;
use App\ObjectValues\PositionStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\RelationManagers\RelationManagerConfiguration;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Class PositionResource
 * @package App\Filament\Resources
 */
class PositionResource extends Resource
{
	/*** @var string|NULL */
	protected static ?string $model = Position::class;
	/*** @var string|NULL */
	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	/*** @var string|NULL */
	protected static ?string $navigationLabel = 'Позиції';

	/**
	 * @param Form $form
	 * @return Form
	 */
	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\TextInput::make('name')
					->required()
					->maxLength(50),
				Forms\Components\Select::make('status')
					->options(PositionStatus::getList())
					->default(PositionStatus::ACTIVE),
			]);
	}

	/**
	 * @param Table $table
	 * @return Table
	 */
	public static function table(Table $table): Table
	{
		$actions = [];
		if (isRoleAdmin()) {
			$actions = [
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
			];
		}
		return $table
			->columns([
				Tables\Columns\TextColumn::make('name'),
				Tables\Columns\TextColumn::make('status'),
			])
			->filters([
			])
			->actions($actions)
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}

	/*** @return array|\class-string[]|RelationGroup[]|RelationManagerConfiguration[] */
	public static function getRelations(): array
	{
		return [
		];
	}

	/*** @return array|PageRegistration[] */
	public static function getPages(): array
	{
		return [
			'index'  => Pages\ListPositions::route('/'),
			'create' => Pages\CreatePosition::route('/create'),
			'edit'   => Pages\EditPosition::route('/{record}/edit'),
		];
	}

	//	use Filament\Pages\Actions\Action;
	//
	//	protected function getActions(): array
	//	{
	//		return [
	//			Action::make('settings')
	//				->label('Settings')
	//				->action('openSettingsModal'),
	//		];
	//	}
}
