<?php

namespace App\Console\Commands;

use App\Models\Flight;
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
	public function handle()
	{
		dd(flightController()->getLastFlightNumber());
	}
}
