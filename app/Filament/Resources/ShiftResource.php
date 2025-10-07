<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftResource\Pages;
use App\Filament\Resources\ShiftResource\RelationManagers;
use App\Models\Position;
use App\Models\Shift;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\RelationManagers\RelationManagerConfiguration;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use function Laravel\Prompts\form;

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
	/*** @var string|NULL */
	protected static ?string $navigationLabel = 'Зміни (Виїзди)';

	/**
	 * @param Form $form
	 * @return Form
	 */
	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\TextInput::make('name')
					->label('Назва (опціонально)'),
				Forms\Components\Select::make('position_id')
					->label('Позиція')
					->required()
					->options(positionController()->getNameList()),
				Forms\Components\TextInput::make('crew')
					->label('Екіпаж')
					->required(),
				Forms\Components\Fieldset::make('Дрони')
					->schema([
						Forms\Components\Repeater::make('drone_items')
							->hiddenLabel()
							->schema([
								Forms\Components\TextInput::make('serial_number')
									->label('Серійний номер'),
							])
							->addActionLabel('Додати')
							->columnSpanFull()
							->collapsible(),
					]),
				Forms\Components\DatePicker::make('shift_start_at')
					->label('Дата початку зміни')
					->required()
					->timezone('Europe/Kyiv')
					->format('Y-m-d')
					->default(now()->format('Y-m-d')),
			]);
	}

	/**
	 * @param Table $table
	 * @return Table
	 */
	public static function table(Table $table): Table
	{
		$actions = [
			Tables\Actions\ViewAction::make()
				->modalHeading('Деталі')
				->modalCancelAction(FALSE)
				->form([
					Forms\Components\TextInput::make('position')
						->label('Позиція')
						->formatStateUsing(function(Shift $record): string {
							return positionController()->findById($record->position_id)->name;
						}),
					Forms\Components\TextInput::make('crew')
						->label('Екіпаж'),
					Forms\Components\Repeater::make('drones')
						->label('Дрони')
						->schema([
							Forms\Components\TextInput::make('serial_number')
								->label('Серійний номер')
								->disabled(),
						])
						->default(fn($record) => $record->drones ?? [])
						->disabled()
						->columns(1),
					Forms\Components\TextInput::make('status')
						->label('Статус'),
				]),
		];
		if (isRoleAdmin()) {
			$actions[] = Tables\Actions\EditAction::make();
			$actions[] = Tables\Actions\DeleteAction::make();
		} else if (isRoleOwner()) {
			$actions[] = Tables\Actions\EditAction::make();
		}
		return $table
			->columns([
				Tables\Columns\TextColumn::make('name')->label('Назва'),
				Tables\Columns\TextColumn::make('position')
					->label('Позиція')
					->formatStateUsing(function(Shift $record): string {
						return positionController()->findById($record->position_id)->name;
					})
					->getStateUsing(fn() => ['Активна']),
				Tables\Columns\TextColumn::make('crew')->label('Екіпаж'),
				Tables\Columns\TextColumn::make('shift_start_at')->label('Дата початку'),
				Tables\Columns\TextColumn::make('shift_end_at')->label('Дата завершення'),
			])//->recordUrl(fn(Shift $record) => static::getUrl('view', ['record' => $record]))
			->recordUrl(NULL)
			->filters([
			])
			->actions($actions)
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			])
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
			'index'  => Pages\ListShifts::route('/'),
			'create' => Pages\CreateShift::route('/create'),
			'edit'   => Pages\EditShift::route('/{record}/edit'),
		];
	}

	/*** @return Builder */
	public static function getEloquentQuery(): Builder
	{
		$query = Shift::query();
		if (isRoleAdmin()) {
			return $query;
		}
		return $query->where('user_id', '=', auth()->id());
	}

	/*** @return bool */
	public static function canCreate(): bool
	{
		if (empty(Position::all())) {
			return FALSE;
		}
		return TRUE;
	}

	//	/**
	//	 * @param Infolist $infolist
	//	 * @return Infolist
	//	 */
	//	public static function infolist(Infolist $infolist): Infolist
	//	{
	//		return $infolist
	//			->schema([
	//				Tabs::make('Tabs')
	//					->tabs([
	//						Tab::make('Details')
	//							->schema([
	//								TextEntry::make('name')
	//									->label('Назва'),
	//							]),
	//						Tab::make('Logs')
	//							->badge(5) // Example badge
	//							->schema([
	//								// Fields for the activity tab
	//							]),
	//						Tab::make('actions')
	//							->badge(5) // Example badge
	//							->schema([
	//								ViewEntry::make('custom_actions')
	//									->view('filament.resources.shift-resource.pages.update-shift'),
	//								// Fields for the activity tab
	//							]),
	//					]),
	//			]);
	//	}
}
