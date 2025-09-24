<?php

use App\ObjectValues\DroneStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/*** Run the migrations. */
	public function up(): void
	{
		Schema::create('drones', function(Blueprint $table) {
			$table->id();
			$table->string('name')->nullable();
			$table->string('drone_serial_number')->unique();
			$table->string('status')->default(DroneStatus::WORKED);
			$table->timestamps();
		});
	}

	/*** Reverse the migrations. */
	public function down(): void
	{
		Schema::dropIfExists('drones');
	}
};
