<?php

namespace App\Filament\Resources\FlightResource\Pages;

use App\Filament\Resources\FlightResource;
use App\Models\Shift;
use App\ObjectValues\ShiftStatus;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

/**
 * Class ListFlights
 * @package App\Filament\Resources\FlightResource\Pages
 */
class ListFlights extends ListRecords
{
	/*** @var string */
	protected static string $resource = FlightResource::class;
	/*** @var string|NULL */
	protected static ?string $title = 'Польоти';

	/*** @return array|string[] */
	public function getBreadcrumbs(): array
	{
		return [];
	}

	/*** @return array|Actions\Action[]|Actions\ActionGroup[] */
	protected function getHeaderActions(): array
	{
		$actions = [];
		if (auth()->user()->isPremium()) {
			$flights = flightController()->getForDay(Shift::query()->where('user_id', '=', auth()->id())->value('id'));
			if ( ! empty($flights->items)) {
				$actions[] = Action::make('report_daily')
					->label('Звіт за день')
					->icon('heroicon-o-rectangle-stack')
					//				->form([
					//					Forms\Components\DatePicker::make('selected_date')
					//						->label('Дата')
					//						->default(Carbon::now('Europe/Kyiv')->toDateString())
					//						->live()
					//						->afterStateUpdated(function(?string $state, ?string $old) {
					//						}),
					//				])
					->modalHeading('Звіт за ' . $flights->first()->date)
					->modalContent(fn($record): View => view(
						'filament.resources.flight-resource.pages.report-flight-daily',
						['date' => $flights->first()->date, 'flights' => $flights]
					))
					->modalSubmitAction(FALSE)
					->modalCancelActionLabel('Close');
			}
		}
		if ((isRoleAdmin() || isRoleOwner()) && (Shift::query()->where('user_id', '=', auth()->id())->where('status', '=', ShiftStatus::ACTIVE)->first() !== NULL)) {
			$actions[] = Actions\CreateAction::make()
				->label('Додати')
				->icon('heroicon-o-plus');
		}
		return $actions;
	}
}
