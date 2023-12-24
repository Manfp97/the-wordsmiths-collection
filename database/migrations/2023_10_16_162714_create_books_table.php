<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
	public function up()
	{
		Schema::create('books', function (Blueprint $table) {
			$table->id();
			$table->foreignId('upload_id');
			$table->string('isbn')->unique();
			$table->string('title');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('books');
	}
}