<?php

namespace App\Filament\Resources\FlightResource\Pages;

use App\Filament\Resources\FlightResource;
use Filament\Resources\Pages\Page;

/**
 * Class ReportFlight
 * @package App\Filament\Resources\FlightResource\Pages
 */
class ReportFlight extends Page
{
	/*** @var string */
	protected static string $resource = FlightResource::class;
	/*** @var string */
	protected static string $view = 'filament.resources.flight-resource.pages.report-flight';
}
