<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookReviewsTable extends Migration
{
	public function up()
	{
		Schema::create('book_reviews', function (Blueprint $table) {
			$table->id();
			$table->foreignId('book_id')->constrained();
			$table->foreignId('user_id')->constrained();
			$table->unsignedTinyInteger('rating')->comment('From 1 to 5');
			$table->text('review_text')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('book_reviews');
	}
}
