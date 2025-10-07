<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/*** Run the migrations. */
	public function up(): void
	{
		Schema::create('log_positions', function(Blueprint $table) {
			$table->id();
			$table->integer('user_id');
			$table->integer('position_id');
			$table->string('action');
			$table->string('field')->nullable();
			$table->string('prev_value')->nullable();
			$table->string('new_value')->nullable();
			$table->timestamps();
		});
	}

	/*** Reverse the migrations. */
	public function down(): void
	{
		Schema::dropIfExists('log_positions');
	}
};
