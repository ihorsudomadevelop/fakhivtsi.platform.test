<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Models\Flight;
use App\ObjectValues\Target;
use App\ObjectValues\TargetStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\RelationManagers\RelationManagerConfiguration;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FlightResource
 * @package App\Filament\Resources
 */
class FlightResource extends Resource
{
	/*** @var string|NULL */
	protected static ?string $model = Flight::class;

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
					->required()
					->options(positionController()->getNameList()),
				Forms\Components\Select::make('target')
					->required()
					->options(Target::getList()),
				Forms\Components\TextInput::make('coordinates')
					->required(),
				Forms\Components\Fieldset::make('Flight time')
					->schema([
						Forms\Components\TimePicker::make('flight_time_start')
							->required()
							->format('H:i')
							->timezone('Europe/Kyiv')
							->native(FALSE)
							->seconds(FALSE),
						Forms\Components\TimePicker::make('flight_time_end')
							->required()
							->format('H:i')
							->timezone('Europe/Kyiv')
							->native(FALSE)
							->seconds(FALSE),
					]),
				Forms\Components\Select::make('target_status')
					->required()
					->options(TargetStatus::getList()),//->visibleOn('edit'),
			]);
	}

	/**
	 * @param Table $table
	 * @return Table
	 */
	public static function table(Table $table): Table
	{
		$actions     = [
			//			Tables\Actions\ViewAction::make()
			//				->form([
			//					Forms\Components\TextInput::make('position'),
			//					Forms\Components\TextInput::make('flight_number'),
			//					Forms\Components\TextInput::make('drone_serial_number'),
			//					Forms\Components\TextInput::make('coordinates'),
			//				]),
		];
		$bulkActions = [];
		if (auth()->user()->isPremium()) {
			$actions[] = Tables\Actions\Action::make('report')
				->label('Report')
				->icon('heroicon-o-rectangle-stack')
				->modalContent(fn($record): View => view(
					'filament.resources.flight-resource.pages.report-flight',
					['record' => $record]
				))
				->modalSubmitAction(FALSE)
				->modalCancelActionLabel('Close');
		}
		if (isRoleAdmin()) {
			$actions[]     = Tables\Actions\EditAction::make();
			$bulkActions[] = Tables\Actions\BulkActionGroup::make([
				Tables\Actions\DeleteBulkAction::make(),
			]);
		}
		return $table
			->columns([
				Tables\Columns\TextColumn::make('date'),
				Tables\Columns\TextColumn::make('position'),
				Tables\Columns\TextColumn::make('flight_number'),
				Tables\Columns\TextColumn::make('drone_serial_number'),
				Tables\Columns\TextColumn::make('target'),
				Tables\Columns\TextColumn::make('ammunition'),
			])
			->filters([
				//			Filter::make('drone_serial_number')
				//					->label('Drone Serial Number')
				//					->form([Forms\Components\TextInput::make('drone_serial_number'),])
				//					->query(fn(Builder $query): Builder => $query->where('drone_serial_number', '=', '1000035416')),
			])
			->actions($actions)
			->bulkActions($bulkActions);
	}

	/*** @return array|class-string[]|RelationGroup[]|RelationManagerConfiguration[] */
	public static function getRelations(): array
	{
		return [
		];
	}

	/*** @return array|PageRegistration[] */
	public static function getPages(): array
	{
		return [
			'index'  => Pages\ListFlights::route('/'),
			'create' => Pages\CreateFlight::route('/create'),
			'edit'   => Pages\EditFlight::route('/{record}/edit'),
			'report' => Pages\ReportFlight::route('/{record}/report'),
		];
	}
}
