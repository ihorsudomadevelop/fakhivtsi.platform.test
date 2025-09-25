<?php

use App\ModelControllers\AmmunitionController;
use App\ModelControllers\FlightController;
use App\ModelControllers\PositionController;

if ( ! function_exists('flightController')) {
	/*** @return FlightController */
	function flightController(): FlightController
	{
		return app('FlightController');
	}
}
if ( ! function_exists('positionController')) {
	/*** @return PositionController */
	function positionController(): PositionController
	{
		return app('PositionController');
	}
}
if ( ! function_exists('ammunitionController')) {
	/*** @return AmmunitionController */
	function ammunitionController(): AmmunitionController
	{
		return app('AmmunitionController');
	}
}