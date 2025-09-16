<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class DataController
 * @package App\Http\Controllers
 */
class DataController extends Controller
{
	/**
	 * @param $date
	 * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|View
	 */
	public function getDailyFlightData($date)
	{
		$flights = flightController()->getForDay($date);
		return view(
			'filament.resources.flight-resource.pages.report-flight-daily',
			compact('date', 'flights')
		);
	}
}