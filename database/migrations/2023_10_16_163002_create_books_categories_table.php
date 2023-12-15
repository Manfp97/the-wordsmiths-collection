<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksCategoriesTable extends Migration
{
	public function up()
	{
		Schema::create('books_categories', function (Blueprint $table) {
			$table->foreignId('category_id')->constrained();
			$table->foreignId('book_id')->constrained();
			
			$table->primary(['category_id', 'book_id']);
		});
	}

	public function down()
	{
		Schema::dropIfExists('books_categories');
	}
}
