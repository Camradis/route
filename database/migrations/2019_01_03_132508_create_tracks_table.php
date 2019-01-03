<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration
{
	public function up()
	{
		Schema::create('tracks', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('attachment');
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('tracks');
	}
}
