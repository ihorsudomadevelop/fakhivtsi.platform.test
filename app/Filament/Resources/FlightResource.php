<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Models\Flight;
use App\Models\Shift;
use App\ObjectValues\ShiftStatus;
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
use Illuminate\Contracts\View\View;

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
	/*** @var string|NULL */
	protected static ?string $navigationLabel = 'Польоти';

	/**
	 * @param Form $form
	 * @return Form
	 */
	public static function form(Form $form): Form
	{
		return $form
			->schema([
				//				Forms\Components\Select::make('position')
				//					->label('Позиція')
				//					->required()
				//					->options(positionController()->getNameList()),
				Forms\Components\Select::make('target')
					->label('Ціль')
					->required()
					->options(Target::getList()),
				Forms\Components\Textarea::make('coordinates')
					->label('Координати (MGRS)')
					->required(),
				Forms\Components\Fieldset::make('Час польоту')
					->schema([
						Forms\Components\TimePicker::make('flight_time_start')
							->label('Зліт')
							->required()
							->format('H:i')
							->timezone('Europe/Kyiv')
							->native(FALSE)
							->seconds(FALSE),
						Forms\Components\TimePicker::make('flight_time_end')
							->label('Посадка')
							->required()
							->format('H:i')
							->timezone('Europe/Kyiv')
							->native(FALSE)
							->seconds(FALSE),
					]),
				Forms\Components\Select::make('target_status')
					->label('Статус по цілі')
					->required()
					->options(TargetStatus::getList()),
				Forms\Components\Fieldset::make('БК')
					->schema([
						Forms\Components\Repeater::make('ammunition_items')
							->hiddenLabel()
							->schema([
								Forms\Components\Fieldset::make('')
									->hiddenLabel()
									->schema([
										Forms\Components\Select::make('ammunition')
											->label('Назва')
											->options(ammunitionController()->getTitleList()),
										Forms\Components\TextInput::make('quantity')
											->label('Кількість')
											->required()
											->default(1),
									]),
							])
							->addActionLabel('Додати')
							->columnSpanFull()
							->collapsible(),
					]),
			]);
	}

	/**
	 * @param Table $table
	 * @return Table
	 */
	public static function table(Table $table): Table
	{
		$actions     = [
			Tables\Actions\ViewAction::make()
				->form([
					Forms\Components\TextInput::make('flight_number'),
					Forms\Components\TextInput::make('coordinates'),
				]),
		];
		$bulkActions = [];
		if (auth()->user()->isPremium()) {
			$actions[] = Tables\Actions\Action::make('report')
				->label('Звіт')
				->icon('heroicon-o-rectangle-stack')
				->modalHeading('Звіт за виліт')
				->modalContent(fn($record): View => view(
					'filament.resources.flight-resource.pages.report-flight',
					['record' => $record]
				))
				->modalSubmitAction(FALSE)
				->modalCancelAction(FALSE);
		}
		if (isRoleAdmin()) {
			$actions[]     = Tables\Actions\EditAction::make();
			$bulkActions[] = Tables\Actions\BulkActionGroup::make([
				Tables\Actions\DeleteBulkAction::make(),
			]);
		}
		return $table
			->columns([
				Tables\Columns\TextColumn::make('date')->label('Дата'),
				Tables\Columns\TextColumn::make('position')
					->label('Позиція')
					->formatStateUsing(function(Flight $record): string {
						return positionController()->findById($record->position_id)->name;
					})
					->getStateUsing(fn() => 'Активна'),
				Tables\Columns\TextColumn::make('flight_number')->label('Номер вильоту'),
				Tables\Columns\TextColumn::make('drone_serial_number')->label('СН дрону'),
				Tables\Columns\TextColumn::make('target')->label('Ціль'),
			])->recordUrl(NULL)
			->filters([
			])
			->actions($actions)
			->bulkActions($bulkActions)
			->emptyStateHeading('Записів не знайдено');
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

	/*** @return bool */
	public static function canCreate(): bool
	{
		if (Shift::query()->where('user_id', '=', auth()->id())->where('status', '=', ShiftStatus::ACTIVE)->first() === NULL) {
			return FALSE;
		}
		return TRUE;
	}
}
