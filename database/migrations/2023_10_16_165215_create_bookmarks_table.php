<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
	public function up()
	{
		Schema::create('bookmarks', function (Blueprint $table) {
			$table->id();
			$table->foreignId('book_id')->constrained();
			$table->foreignId('user_id')->constrained();
			$table->integer('page_number');
			$table->boolean('is_favorite');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('bookmarks');
	}
}
