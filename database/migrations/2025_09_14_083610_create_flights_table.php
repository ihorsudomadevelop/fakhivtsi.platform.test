<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/*** Run the migrations. */
	public function up(): void
	{
		Schema::create('flights', function(Blueprint $table) {
			$table->id();
			$table->date('date');
			$table->string('call_sign');
			$table->string('position');
			$table->unsignedBigInteger('flight_number');
			$table->string('drone_serial_number');
			$table->string('target');
			$table->string('coordinates');
			$table->string('flight_time');
			$table->string('ammunition');
			$table->string('target_status');
			$table->string('impressed')->nullable();
			$table->string('pilot');
			$table->timestamps();
		});
	}

	/*** Reverse the migrations. */
	public function down(): void
	{
		Schema::dropIfExists('flights');
	}
};
