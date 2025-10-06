<?php

use App\ObjectValues\ShiftStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/*** Run the migrations. */
	public function up(): void
	{
		Schema::table('shifts', function(Blueprint $table) {
			$table->string('status')->after('drones')->default(ShiftStatus::ACTIVE);
			$table->string('watch_time_end')->after('drones');
			$table->string('watch_time_start')->after('drones');
		});
	}
};
