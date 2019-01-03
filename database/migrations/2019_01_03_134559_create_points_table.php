<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
	public function up()
	{
		Schema::create('points', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('track_id');
			$table->decimal('longitude', 10, 7);
			$table->decimal('latitude', 10, 7);
			$table->decimal('altitude');
			$table->string('displacement_sequence');
			$table->timestamp('tracked_at');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('points');
	}
}
