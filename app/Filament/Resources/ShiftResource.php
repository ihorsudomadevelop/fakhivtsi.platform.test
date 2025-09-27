<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftResource\Pages;
use App\Filament\Resources\ShiftResource\RelationManagers;
use App\Models\Shift;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\RelationManagers\RelationManagerConfiguration;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Class ShiftResource
 * @package App\Filament\Resources
 */
class ShiftResource extends Resource
{
	/*** @var string|NULL */
	protected static ?string $model = Shift::class;

	/*** @var string|NULL */
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
					->label('Позиція')
					->required()
					->options(positionController()->getNameList()),
				Forms\Components\Fieldset::make('Дрони')
					->schema([
						Forms\Components\Repeater::make('drone_items')
							->hiddenLabel()
							->schema([
								Forms\Components\Fieldset::make('')
									->hiddenLabel()
									->schema([
										Forms\Components\TextInput::make('serial_number')
											->label('Серійний номер'),
									]),
							])
							->addActionLabel('Додати')
							->columnSpanFull()
							->collapsible(),
					]),
				Forms\Components\DatePicker::make('shift_start_at')
					->label('Дата початку зміни')
					->required()
					->timezone('Europe/Kyiv')
					->format('Y-m-d'),
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
				Tables\Columns\TextColumn::make('name')->label('Назва'),
				Tables\Columns\TextColumn::make('position')->label('Позиція'),
				Tables\Columns\TextColumn::make('shift_start_at')->label('Дата початку'),

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

	/*** @return array|class-string[]|RelationGroup[]|RelationManagerConfiguration[] */
	public static function getRelations(): array
	{
		return [
			//
		];
	}

	/*** @return array|PageRegistration[] */
	public static function getPages(): array
	{
		return [
			'index'  => Pages\ListShifts::route('/'),
			'create' => Pages\CreateShift::route('/create'),
			'edit'   => Pages\EditShift::route('/{record}/edit'),
		];
	}
}
