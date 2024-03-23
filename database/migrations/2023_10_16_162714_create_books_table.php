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
			$table->string('isbn')->unique();
			$table->string('slug')->unique();
			$table->string('title');
			$table->text('description');
			$table->unsignedSmallInteger('page_count');
			$table->string('language');
			$table->unsignedSmallInteger('year');
			$table->boolean('is_premium')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('books');
	}
}
