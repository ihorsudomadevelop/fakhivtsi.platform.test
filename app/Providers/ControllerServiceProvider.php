<?php

namespace App\Providers;

use App\ModelControllers\FlightController;
use App\ModelControllers\PositionController;
use Illuminate\Support\ServiceProvider;

/**
 * Class ControllerServiceProvider
 * @package App\Providers
 */
class ControllerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 * @return void
	 */
	public function boot(): void
	{
		$this->app->singleton(FlightController::class);
		$this->app->alias(FlightController::class, 'FlightController');
		$this->app->singleton(PositionController::class);
		$this->app->alias(PositionController::class, 'PositionController');
	}
}
