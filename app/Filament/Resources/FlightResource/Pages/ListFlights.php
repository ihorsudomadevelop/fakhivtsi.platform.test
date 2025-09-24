<?php

namespace App\Filament\Resources\FlightResource\Pages;

use App\Filament\Resources\FlightResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
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

	/*** @return array|Actions\Action[]|Actions\ActionGroup[] */
	protected function getHeaderActions(): array
	{
		$actions = [];
		if (auth()->user()->isPremium()) {
			$date      = '2025-09-13';
			$actions[] = Action::make('report_daily')
				->label('Daily report')
				->icon('heroicon-o-rectangle-stack')
				->modalHeading('Звіт за ' . $date)
				->modalContent(fn($record): View => view(
					'filament.resources.flight-resource.pages.report-flight-daily',
					['date' => $date, 'flights' => flightController()->getForDay($date)]
				))
				->modalSubmitAction(FALSE)
				->modalCancelActionLabel('Close');
			//				->form([
			//					Forms\Components\DatePicker::make('selected_date')
			//						->label('Дата')
			//						->default(Carbon::now('Europe/Kyiv')->toDateString())
			//						->required(),
			//				])
		}
		if (isRoleAdmin()) {
			$actions[] = Actions\CreateAction::make()
				->icon('heroicon-o-plus');
		}
		return $actions;
	}
}
