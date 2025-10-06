<?php

namespace App\Console\Commands;

use App\Models\Flight;
use App\Models\Position;
use App\Models\Shift;
use App\ObjectValues\ShiftStatus;
use Illuminate\Console\Command;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class TestCommand
 * @package App\Console\Commands
 */
class TestCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 * @var string
	 */
	protected $signature = 'app:test-command';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Command description';

	/*** Execute the console command. */
	#[NoReturn]
	public function handle(): void
	{
		dd(Position::all());
		//dd(Shift::query()->where('user_id', '=', 1)->where('status', '=', ShiftStatus::ACTIVE)->first());
		//dd($query = Flight::query()->where('user_id', '=', auth()->id())->);
		//$lastFlightNumber = flightController()->getLastFlightNumber(2);
		//echo $lastFlightNumber > 0 ? $lastFlightNumber + 1 : 1;
	}
}
