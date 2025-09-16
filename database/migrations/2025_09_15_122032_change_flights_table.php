<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/*** Run the migrations. */
	public function up(): void
	{
		Schema::table('flights', function(Blueprint $table) {
			$table->string('flight_time_end')->after('flight_time');
			$table->renameColumn('flight_time', 'flight_time_start');
		});
	}
};
