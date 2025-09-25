<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftResource\Pages;
use App\Filament\Resources\ShiftResource\RelationManagers;
use App\Models\Shift;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Class ShiftResource
 * @package App\Filament\Resources
 */
class ShiftResource extends Resource
{
	/*** @var string|null */
	protected static ?string $model = Shift::class;

	/*** @var string|null */
	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	/**
	 * @param Form $form
	 * @return Form
	 */
	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\Select::make('position')
					->required()
					->options(positionController()->getNameList()),
				Forms\Components\DatePicker::make('shift_start_at')
					->required(),
			]);
	}

	/**
	 * @param Table $table
	 * @return Table
	 */
	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\TextColumn::make('name'),
				Tables\Columns\TextColumn::make('drones'),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}

	/**
	 * @return array|\class-string[]|RelationGroup[]|\Filament\Resources\RelationManagers\RelationManagerConfiguration[]
	 */
	public static function getRelations(): array
	{
		return [
			//
		];
	}

	/**
	 * @return array|\Filament\Resources\Pages\PageRegistration[]
	 */
	public static function getPages(): array
	{
		return [
			'index'  => Pages\ListShifts::route('/'),
			'create' => Pages\CreateShift::route('/create'),
			'edit'   => Pages\EditShift::route('/{record}/edit'),
		];
	}
}
