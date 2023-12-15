<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksAuthorsTable extends Migration
{
	public function up()
	{
		Schema::create('books_authors', function (Blueprint $table) {
			$table->foreignId('book_id')->constrained();
			$table->foreignId('author_id')->constrained();

			$table->primary(['book_id', 'author_id']);
		});
	}

	public function down()
	{
		Schema::dropIfExists('books_authors');
	}
}
